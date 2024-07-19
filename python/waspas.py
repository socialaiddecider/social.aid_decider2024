import mysql.connector
import sys
import os
from dotenv import load_dotenv

load_dotenv()
host_url = os.getenv("DB_HOST")
port_db = os.getenv("DB_PORT")
user_db = os.getenv("DB_USERNAME")
password_db = os.getenv("DB_PASSWORD")
database_name = os.getenv("DB_DATABASE")

# Konfigurasi koneksi database
db = mysql.connector.connect(
    host=host_url,
    port=port_db,
    user=user_db,
    password=password_db,
    database=database_name,
)

# Menerima argumen periode dari controller
periode = sys.argv[1]
# print(periode)

# Parse periode menjadi tahun dan bulan
tahun, bulan = map(int, periode.split("-"))

# Buat kursor untuk menjalankan query
cursor = db.cursor()

# Ambil data dari tabel kriteria
cursor.execute("SELECT * FROM kriteria")
kriteria = cursor.fetchall()

# Ambil data dari tabel subkriteria
cursor.execute("SELECT * FROM subkriteria")
subkriteria = cursor.fetchall()

# Ambil data dari tabel alternatif
cursor.execute("SELECT * FROM alternatif")
alternatif = cursor.fetchall()

# Filter data penilaian sesuai dengan periode
query = "SELECT * FROM penilaian WHERE YEAR(created_at) = %s AND MONTH(created_at) = %s"
cursor.execute(query, (tahun, bulan))
penilaian = cursor.fetchall()

# print("penilaian", penilaian)

# Mengambil data jumlah_penerima dari tabel algoritma_genetika
cursor.execute("SELECT jumlah_penerima FROM algoritma_genetika")
jumlah_penerima_result = cursor.fetchone()

# Memastikan bahwa data ditemukan
if jumlah_penerima_result:
    jumlah_penerima = jumlah_penerima_result[0]
else:
    # Jika data tidak ditemukan, berikan nilai default
    jumlah_penerima = 2

# Inisialisasi jenis kriteria dan bobot, dan jumlah penerima
jenis_kriteria = []
bobot = []
for k in kriteria:
    jenis_kriteria.append(k[3])  # Mengambil nilai jenis kriteria dari kolom pertama
    bobot.append(k[4])  # Mengambil nilai bobot dari kolom kedua (asumsi)

# print(bobot)

# Inisialisasi matriks nilai (2 dimensi)
matriks_nilai = [[0 for _ in range(len(kriteria))] for _ in range(len(alternatif))]


# Fungsi get nilai alternatif perkriteria
def get_nilai_penilaian(alternatif_id, kriteria_id):
    for p in penilaian:
        if p[1] == alternatif_id and p[2] == kriteria_id:
            return p[3]
    return None  # Nilai default jika tidak ditemukan


# Proses data penilaian
for i, alternatif_data in enumerate(alternatif):
    alternatif_id = alternatif_data[0]
    for j, kriteria_data in enumerate(kriteria):
        kriteria_id = kriteria_data[0]
        nilai_penilaian = get_nilai_penilaian(alternatif_id, kriteria_id)
        matriks_nilai[i][j] = nilai_penilaian if nilai_penilaian is not None else 0


# print("matriks nilai :", matriks_nilai)


# FUNGSI WASPAS
def nilai_waspas(kriteria, jenis_kriteria, bobot, alternatif, matriks_nilai):
    # 1. Menentukan nilai max dan min matriks nilai
    nilai_max = []
    nilai_min = []

    for i in range(len(kriteria)):
        nilai_max.append(0)
        nilai_min.append(0)
        for j in range(len(alternatif)):
            if (j == 0) or (nilai_max[i] < matriks_nilai[j][i]):
                nilai_max[i] = matriks_nilai[j][i]
            if (j == 0) or (nilai_min[i] > matriks_nilai[j][i]):
                nilai_min[i] = matriks_nilai[j][i]

        # print(nilai_max, nilai_min)

    # 2. Matriks Normalisasi
    matriks_normalisasi = []
    for i in range(len(alternatif)):
        matriks_normalisasi.append([])
        for j in range(len(kriteria)):
            matriks_normalisasi[i].append(0)
            if jenis_kriteria[j] == "benefit":
                matriks_normalisasi[i][j] = matriks_nilai[i][j] / (nilai_max[j] + 1)
            else:
                matriks_normalisasi[i][j] = nilai_min[j] / (matriks_nilai[i][j] + 1)
    # print("matriks ternormalisasi :")
    # print(matriks_normalisasi)

    # Simpan hasil normalisasi ke database
    for i, alternatif_data in enumerate(alternatif):
        alternatif_id = alternatif_data[0]
        for j, kriteria_data in enumerate(kriteria):
            kriteria_id = kriteria_data[0]
            # Cek apakah hasil perhitungan sudah tersedia dalam database untuk alternatif dan kriteria yang sama
            cursor.execute(
                "SELECT id FROM normalisasi WHERE alternatif_id = %s AND kriteria_id = %s",
                (alternatif_id, kriteria_id),
            )
            existing_result = cursor.fetchone()

            if existing_result:
                # Jika sudah ada, update hasil perhitungan
                # print(matriks_normalisasi[i])[j]
                cursor.execute(
                    "UPDATE normalisasi SET nilai = %s WHERE id = %s",
                    (matriks_normalisasi[i][j], existing_result[0]),
                )
            else:
                # Jika belum ada, simpan hasil perhitungan baru ke database
                cursor.execute(
                    "INSERT INTO normalisasi (alternatif_id, kriteria_id, nilai) VALUES (%s, %s, %s)",
                    (alternatif_id, kriteria_id, matriks_normalisasi[i][j]),
                )

    db.commit()  # Simpan perubahan ke database

    # 3. Nilai Qi(1) -> Jumlah_kali
    jumlah_kali = []
    for i in range(len(alternatif)):
        jumlah_kali.append(0)
        for j in range(len(kriteria)):
            jumlah_kali[i] = jumlah_kali[i] + (matriks_normalisasi[i][j] * bobot[j])
    # print("Q1 :")
    # print(jumlah_kali)

    # Simpan hasil jumlah_kali ke database
    for i, alternatif_data in enumerate(alternatif):
        alternatif_id = alternatif_data[0]
        # Cek apakah hasil perhitungan sudah tersedia dalam database untuk alternatif yang sama
        cursor.execute(
            "SELECT id FROM jumlah_kali WHERE alternatif_id = %s", (alternatif_id,)
        )
        existing_result = cursor.fetchone()

        if existing_result:
            # Jika sudah ada, update hasil perhitungan
            cursor.execute(
                "UPDATE jumlah_kali SET nilai = %s WHERE id = %s",
                (jumlah_kali[i], existing_result[0]),
            )
        else:
            # Jika belum ada, simpan hasil perhitungan baru ke database
            cursor.execute(
                "INSERT INTO jumlah_kali (alternatif_id, nilai) VALUES (%s, %s)",
                (alternatif_id, jumlah_kali[i]),
            )

    db.commit()

    # 4. Nilai Qi(2) -> Kali_pangkat
    kali_pangkat = []
    for i in range(len(alternatif)):
        kali_pangkat.append(1)
        for j in range(len(kriteria)):
            kali_pangkat[i] = kali_pangkat[i] * (matriks_normalisasi[i][j] ** bobot[j])
    #   print("Q2 :")
    #   print(kali_pangkat)

    # Simpan hasil kali_pangkat ke database
    for i, alternatif_data in enumerate(alternatif):
        alternatif_id = alternatif_data[0]
        # Cek apakah hasil perhitungan sudah tersedia dalam database untuk alternatif yang sama
        cursor.execute(
            "SELECT id FROM kali_pangkat WHERE alternatif_id = %s", (alternatif_id,)
        )
        existing_result = cursor.fetchone()

        if existing_result:
            # Jika sudah ada, update hasil perhitungan
            cursor.execute(
                "UPDATE kali_pangkat SET nilai = %s WHERE id = %s",
                (kali_pangkat[i], existing_result[0]),
            )
        else:
            # Jika belum ada, simpan hasil perhitungan baru ke database
            cursor.execute(
                "INSERT INTO kali_pangkat (alternatif_id, nilai) VALUES (%s, %s)",
                (alternatif_id, kali_pangkat[i]),
            )

    db.commit()

    # 5. Hasil Akhir
    hasil_akhir = []
    for i in range(len(alternatif)):
        hasil_akhir.append(0)
        hasil_akhir[i] = (0.5 * jumlah_kali[i]) + (0.5 * kali_pangkat[i])
    #   print("hasil akhir :")
    #   print(hasil_akhir)

    # Simpan hasil hasil akhir waspas ke database
    for i, alternatif_data in enumerate(alternatif):
        alternatif_id = alternatif_data[0]
        # Cek apakah hasil perhitungan sudah tersedia dalam database untuk alternatif yang sama
        cursor.execute(
            "SELECT id FROM hasil_spk WHERE alternatif_id = %s", (alternatif_id,)
        )
        existing_result = cursor.fetchone()

        if existing_result:
            # Jika sudah ada, update hasil perhitungan
            cursor.execute(
                "UPDATE hasil_spk SET nilai = %s WHERE id = %s",
                (hasil_akhir[i], existing_result[0]),
            )
        else:
            # Jika belum ada, simpan hasil perhitungan baru ke database
            cursor.execute(
                "INSERT INTO hasil_spk (alternatif_id, nilai) VALUES (%s, %s)",
                (alternatif_id, hasil_akhir[i]),
            )

    db.commit()

    # 6. Ranking
    alternatif_rank = []
    hasil_akhir_rank = []
    for i in range(len(alternatif)):
        alternatif_rank.append(alternatif[i])
        hasil_akhir_rank.append(hasil_akhir[i])

    for i in range(len(alternatif)):
        for j in range(len(alternatif)):
            if j > i:
                if hasil_akhir_rank[i] < hasil_akhir_rank[j]:
                    tmp_alternatif = alternatif_rank[i]
                    tmp_hasil_akhir = hasil_akhir_rank[i]
                    alternatif_rank[i] = alternatif_rank[j]
                    hasil_akhir_rank[i] = hasil_akhir_rank[j]
                    alternatif_rank[j] = tmp_alternatif
                    hasil_akhir_rank[j] = tmp_hasil_akhir
    #   print(alternatif_rank)
    #   print(hasil_akhir_rank)

    # Simpan hasil penerima ke database
    # for i in range(len(alternatif)):
    #     # Buat string datetime lengkap dengan menambahkan tanggal dan waktu ke periode
    #     periode_datetime = f"{periode}-01 00:00:00"

    #     # Cek ketersediaan data pada tabel penerima
    #     cursor.execute("SELECT id FROM penerima WHERE alternatif_id = %s AND DATE_FORMAT(created_at, '%%Y-%%m') = %s", (alternatif_rank[i][0], periode_datetime))
    #     existing_result = cursor.fetchone()

    #     if existing_result:
    #         # Jika sudah ada, lakukan operasi update
    #         cursor.execute("UPDATE penerima SET nilai = %s WHERE id = %s", (hasil_akhir_rank[i], existing_result[0]))
    #     else:
    #         # Jika belum ada, simpan hasil perhitungan baru ke database
    #         cursor.execute("INSERT INTO penerima (alternatif_id, nilai, created_at) VALUES (%s, %s, %s)",
    #                         (alternatif_rank[i][0], hasil_akhir_rank[i], periode_datetime))

    #         # Tambahkan baris ini untuk membaca hasil setiap eksekusi query
    #         cursor.fetchall()

    # db.commit()

    return (
        matriks_normalisasi,
        jumlah_kali,
        kali_pangkat,
        hasil_akhir,
        alternatif_rank,
        hasil_akhir_rank,
    )


# Konversi Status
def konversi_status(nilai_akhir, index, jumlah_penerima):
    # Pengecekan apakah ranking berada didalam jumlah penerima
    if index < jumlah_penerima:
        return "Menerima"
    else:
        return "Tidak Menerima"


# Menghitung Nilai Waspas
(
    matriks_normalisasi,
    jumlah_kali,
    kali_pangkat,
    hasil_akhir,
    alternatif_rank,
    hasil_akhir_rank,
) = nilai_waspas(kriteria, jenis_kriteria, bobot, alternatif, matriks_nilai)
print(alternatif_rank)
print(hasil_akhir_rank)

# Array untuk menyimpan status
status_array = [
    konversi_status(nilai_akhir, i, jumlah_penerima)
    for i, nilai_akhir in enumerate(hasil_akhir_rank)
]
for i, alternatif_data in enumerate(alternatif_rank):
    alternatif_id = alternatif_data[0]
    print(alternatif_id)
    # Buat string datetime lengkap dengan menambahkan tanggal dan waktu ke periode
    periode_date = f"{periode}"  # Hanya menggunakan tahun dan bulan
    # print(periode_date)

    # Pecahkan periode menjadi tahun dan bulan
    tahun, bulan = periode.split("-")
    # Buat string created_at dengan menggunakan tahun dan bulan yang ditentukan
    created_at = f"{tahun}-{bulan}-01"

    # Cek ketersediaan data pada tabel penerima untuk alternatif dan periode yang sama
    cursor.execute(
        "SELECT id FROM penerima WHERE alternatif_id = %s AND YEAR(created_at) = %s AND MONTH(created_at) = %s",
        (alternatif_id, tahun, bulan),
    )
    existing_result = cursor.fetchone()

    # print(existing_result)

    if existing_result:
        # Jika sudah ada, lakukan operasi update
        cursor.execute(
            "UPDATE penerima SET nilai = %s, status = %s WHERE id = %s",
            (hasil_akhir_rank[i], status_array[i], existing_result[0]),
        )
    else:
        # Jika belum ada, simpan hasil perhitungan baru ke database
        cursor.execute(
            "INSERT INTO penerima (alternatif_id, nilai, status, created_at) VALUES (%s, %s, %s, %s)",
            (alternatif_id, hasil_akhir_rank[i], status_array[i], created_at),
        )

db.commit()
