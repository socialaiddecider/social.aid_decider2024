import mysql.connector
import numpy as np
import random
from waspas import nilai_waspas, konversi_status
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
print(periode)

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

# Ambil data asli dari tabel data_asli berdasarkan periode
query = "SELECT data_asli.*, alternatif.kode_alternatif FROM data_asli JOIN alternatif ON data_asli.alternatif_id = alternatif.id WHERE YEAR(data_asli.created_at) = %s AND MONTH(data_asli.created_at) = %s"
cursor.execute(query, (tahun, bulan))
data_asli_filter = cursor.fetchall()

data_asli = {}
for data in data_asli_filter:
    kode_alternatif = data[5]  # Mengambil kode_alternatif sebagai kunci
    status = data[2]  # Mengambil status sebagai nilai
    data_asli[kode_alternatif] = status

# print('data asli', data_asli)
# Ambil data asli dari tabel data_asli
cursor.execute("SELECT * FROM algoritma_genetika")
algoritma_genetika = cursor.fetchall()

# Inisialisasi jenis kriteria dan bobot, dan jumlah penerima
jenis_kriteria = []
bobot = []
for k in kriteria:
    jenis_kriteria.append(k[3])  # Mengambil nilai jenis kriteria dari kolom ketiga
    bobot.append(k[4])  # Mengambil nilai bobot dari kolom keempat

jumlah_penerima = algoritma_genetika[0][5]
# print('jumlah penerima', jumlah_penerima)

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

# ALGORITMA GENETIKA

# Inisialisasi Parameter
num_generations = algoritma_genetika[0][1]
# print('jumlah iterasi', num_generations)   # Jumlah generasi
sol_per_pop = algoritma_genetika[0][2]
# print('popsize', sol_per_pop)   # Ukuran populasi
num_genes = len(kriteria)  # Jumlah gen
init_range_low = 0  # Batas bawah setiap gen
init_range_high = 1  # Batas atas setiap gen


# Fungsi untuk menghitung akurasi
def hitung_akurasi(data_asli, alternatif_rank, hasil_akhir_rank):
    # Array untuk menyimpan status
    status_array = [
        konversi_status(nilai_akhir, i, jumlah_penerima)
        for i, nilai_akhir in enumerate(hasil_akhir_rank)
    ]
    for i in range(len(hasil_akhir_rank)):
        status_array[i]

    sesuai = 0
    for i in range(len(hasil_akhir_rank)):
        # print('alternatif',alternatif_rank[i])

        if status_array[i] == data_asli[alternatif_rank[i][1]]:
            sesuai += 1

    akurasi = (sesuai / len(alternatif_rank)) * 100 / 100

    return akurasi


# Perhitungan nilai fitness untuk setiap solusi yang dihasilkan GA
def fitness_function(solution):

    global bobot
    bobot = solution

    (
        matriks_normalisasi,
        jumlah_kali,
        kali_pangkat,
        hasil_akhir,
        alternatif_rank,
        hasil_akhir_rank,
    ) = nilai_waspas(kriteria, jenis_kriteria, bobot, alternatif, matriks_nilai)
    fitness = hitung_akurasi(data_asli, alternatif_rank, hasil_akhir_rank)

    #   print(f"Perhitungan Nilai Fitness")
    #   print(f"Bobot {solution}")
    #   print(f"Fitness : {fitness}")
    #   print(f"-------------------------------------------------------------------------------------------")

    return [fitness]


# Fungsi Heuristic Crossover
def crossover_func(population):
    offspring = []
    crossover_rate = algoritma_genetika[0][3]
    # print('cr', crossover_rate)
    num_crossovers = crossover_rate * sol_per_pop

    # Memeriksa angka di belakang koma
    if num_crossovers - int(num_crossovers) >= 0.5:
        loop_crossovers = int(num_crossovers) + 1  # Bulatkan ke atas
    else:
        loop_crossovers = int(num_crossovers)  # Bulatkan ke bawah

    for _ in range(loop_crossovers):
        parent1 = population[np.random.randint(0, population.shape[0])]
        parent2 = population[np.random.randint(0, population.shape[0])]

        # Memastikan kedua parent tidak sama
        while np.array_equal(parent1, parent2):
            parent2 = population[np.random.randint(0, population.shape[0])]

        beta = np.random.rand(
            parent1.shape[0]
        )  # Menentukan nilai Beta sesuai jumlah gen

        offspring_new = (
            beta * (parent1 - parent2)
        ) + parent1  # Menghitung offspring baru
        # print(f"Offspring sebelum di abs: {offspring_new}")

        # Memastikan tidak ada nilai gen yang negatif
        offspring_new = np.abs(offspring_new)
        # print(f"Offspring setelah diabs: {offspring_new}")

        offspring_new /= np.sum(offspring_new)  # Normalisasi offspring

        offspring.append(offspring_new)

        # Print output
        # print("Crossover:")
        # print(f"Parent 1: {parent1}")
        # print(f"Parent 2: {parent2}")
        # print(f"Beta: {beta}")
        # print(f"Offspring: {offspring_new}")
        # print("-------------------------------------------------------------------------------------------")

    # print(offspring)
    return np.array(offspring)


# Fungsi Boundary Mutation
def mutation_func(population):
    offspring = []
    min_value = 0.01
    max_value = 0.99

    mutation_rate = algoritma_genetika[0][4]
    # print('mr', mutation_rate)
    num_mutations = mutation_rate * sol_per_pop

    # Memeriksa angka di belakang koma
    if num_mutations - int(num_mutations) >= 0.5:
        loop_mutations = int(num_mutations) + 1  # Bulatkan ke atas
    else:
        loop_mutations = int(num_mutations)  # Bulatkan ke bawah

    for _ in range(loop_mutations):
        # Pilih 1 individu secara acak untuk dilakukan mutasi
        random_chromosome_idx = np.random.randint(0, population.shape[0])

        # print("Mutasi:")
        # print(f"Parent: {population[random_chromosome_idx]}")

        # Pilih gen secara acak
        random_gene_idx = np.random.choice(range(population.shape[1]))

        # Menentukan nilai r
        r = np.random.rand()

        # Mutasi berdasarkan nilai r
        if r < 0.5:
            population[random_chromosome_idx, random_gene_idx] = min_value
        else:
            population[random_chromosome_idx, random_gene_idx] = max_value

        # Normalisasi offspring
        population[random_chromosome_idx] /= population[random_chromosome_idx].sum()

        offspring.append(population[random_chromosome_idx])

        # print(f"Gene idx: {random_gene_idx}")
        # print(f"r: {r}")
        # print(f"Mutated value: {population[random_chromosome_idx, random_gene_idx]}")
        # print(f"Offspring: {population[random_chromosome_idx]}")
        # print(f"-------------------------------------------------------------------------------------------")

    # print(offspring)
    return np.array(offspring)


# Fungsi Seleksi Elitism
def parent_selection_func(combined_fitness, num_parents, combined_population):
    # Mengurutkan indeks populasi berdasarkan nilai fitnessnya dari terbaik ke terburuk
    fitness_sorted = sorted(
        range(len(combined_fitness)), key=lambda k: combined_fitness[k], reverse=True
    )

    # Memilih sejumlah orang tua dari populasi
    parents = np.empty((num_parents, population.shape[1]))
    selected_fitness = np.zeros(
        num_parents
    )  # Array untuk menyimpan fitness orang tua terpilih

    # print(f"Seleksi Parent:")
    for parent_num in range(num_parents):
        # Memilih kromosom dan fitness berdasarkan indeks terurut
        parent_index = fitness_sorted[parent_num]
        parents[parent_num, :] = combined_population[parent_index].copy()
        selected_fitness[parent_num] = combined_fitness[parent_index]

        # Mencetak informasi orang tua terpilih
        # print(f"Kromosom terpilih {parent_num + 1}: {parents[parent_num]} (Fitness: {selected_fitness[parent_num]})")

    # print(f"-------------------------------------------------------------------------------------------")

    return parents, selected_fitness


# Random Populasi Awal
def get_random_values(num_genes, init_range_low, init_range_high):
    # Menghasilkan nilai acak dg panjang gen
    values = [random.uniform(init_range_low, init_range_high) for _ in range(num_genes)]

    # Menormalisasi nilai acak
    total = sum(values)
    normalized_values = [value / total for value in values]  # Agar totalnya = 1

    return normalized_values


# Inisialisasi bobot secara acak
population = [
    get_random_values(num_genes, init_range_low, init_range_high)
    for _ in range(sol_per_pop)
]

# Konversi population menjadi array numpy
population = np.array(population)

# Tampilkan populasi awal
print("Populasi Awal:")
for i, individual in enumerate(population):
    print(f"  Kromosom {i}: {individual}")


# Alur Perhitungan Algoritma Genetika
# Looping algoritma genetika
for generation in range(num_generations):
    # print(f"Generasi {generation + 1}:")

    # Evaluasi fitness
    fitness = [fitness_function(individual) for individual in population]

    # Operasi crossover
    offspring_crossover = crossover_func(population)

    # Operasi mutasi
    offspring_mutated = mutation_func(population)

    # Evaluasi fitness untuk Offspring Hasil Crossover
    crossover_fitness = [
        fitness_function(individual) for individual in offspring_crossover
    ]

    # Evaluasi fitness untuk Offspring Hasil Mutasi
    mutated_fitness = [fitness_function(individual) for individual in offspring_mutated]

    # Menggabungkan fitness dari populasi awal, offspring crossover, dan offspring mutasi
    combined_fitness = np.array(fitness + crossover_fitness + mutated_fitness)
    combined_population = np.concatenate(
        (population, offspring_crossover, offspring_mutated), axis=0
    )

    # Seleksi orang tua dari nilai fitness tertinggi
    elite_parents = parent_selection_func(
        combined_fitness, sol_per_pop, combined_population
    )

    # Ganti populasi dengan orang tua terpilih
    elite_population = elite_parents[0]
    population = elite_population.copy()

    # Cetak individu terbaik dari populasi saat ini
    best_individual = max(population, key=fitness_function)
    best_fitness = fitness_function(best_individual)
    # print(f"Individu terbaik: {best_individual}, Fitness: {best_fitness}")
    # print("--------------------------------------------------------------------------------")


# Simpan hasil bobot terbaik ke database
# Fungsi untuk menyimpan hasil best_individual ke dalam tabel bobot
def save_best_individual_to_database(best_individual):
    # Query untuk mendapatkan informasi kriteria
    cursor.execute("SELECT id, kode_kriteria FROM kriteria")
    kriteria_info = cursor.fetchall()

    # Menginisialisasi daftar nilai untuk dimasukkan ke dalam tabel bobot
    values_to_insert = []

    # Mengisi daftar nilai untuk setiap kriteria dalam best_individual
    for i, bobot in enumerate(best_individual):
        kriteria_id = None
        kode_kriteria = f"C{i+1}"  # Kode kriteria dimulai dari C1, C2, dst.

        # Mencari kriteria_id berdasarkan kode_kriteria
        for kriteria in kriteria_info:
            if kriteria[1] == kode_kriteria:
                kriteria_id = kriteria[0]
                break

        # Memeriksa apakah kriteria_id sudah ada dalam tabel bobot
        cursor.execute("SELECT id FROM bobot WHERE kriteria_id = %s", (kriteria_id,))
        existing_entry = cursor.fetchone()

        if existing_entry:
            # Jika sudah ada, lakukan update nilai bobot
            update_query = "UPDATE bobot SET bobot = %s WHERE kriteria_id = %s"
            cursor.execute(
                update_query, (round(bobot, 3), kriteria_id)
            )  # Bulatkan ke 3 angka dibelakang koma
        else:
            # Jika belum ada, tambahkan nilai untuk dimasukkan ke dalam tabel bobot
            values_to_insert.append(
                (kriteria_id, round(bobot, 3))
            )  # Bulatkan ke 3 angka dibelakang koma

    # Query untuk menyimpan nilai ke dalam tabel bobot
    insert_query = "INSERT INTO bobot (kriteria_id, bobot) VALUES (%s, %s)"

    # Memasukkan nilai baru ke dalam tabel bobot
    cursor.executemany(insert_query, values_to_insert)

    # Commit perubahan ke dalam database
    db.commit()


# Panggil fungsi untuk menyimpan best_individual ke dalam tabel bobot
save_best_individual_to_database(best_individual)
