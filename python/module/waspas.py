#!/usr/bin python3
import module.db as db


class CalcWaspas:

    def __init__(self):
        self.db = db.Connection()
        if self.db.check_connection():
            print("Connected to", self.db.database)

    def get_kriteria(self):
        kriteria = self.db.get_all_data_from_table("kriteria")
        return kriteria

    def get_subkriteria(self):
        subkriteria = self.db.get_all_data_from_table("subkriteria")
        return subkriteria

    def get_alternatif(self):
        alternatif = self.db.get_all_data_from_table("alternatif")
        return alternatif

    def get_penilaian(self, tahun, bulan):
        query = "SELECT * FROM penilaian WHERE YEAR(created_at) = %s AND MONTH(created_at) = %s"
        data = (tahun, bulan)
        penilaian = self.db.execute_query_return_all(query, data)
        return penilaian

    def is_penerima(self):
        query = "SELECT jumlah_penerima FROM algoritma_genetika"
        jumlah_penerima = self.db.execute_query_return_all(query)
        if jumlah_penerima.__len__() > 0:
            jumlah_penerima = jumlah_penerima[0][0]
        else:
            jumlah_penerima = -1
        self.jumlah_penerima = jumlah_penerima
        return jumlah_penerima

    def get_bobot_jenis_kriteria(self):
        jenis_kriteria = []
        bobot = []
        for k in self.get_kriteria():
            jenis_kriteria.append(k[3])
            jenis_kriteria.append(k[4])
        self.jenis_kriteria = jenis_kriteria
        self.bobot = bobot
        return jenis_kriteria, bobot

    def init_matriks_nilai(self):
        kriteria = self.get_kriteria()
        alternatif = self.get_alternatif()
        return [[0 for _ in range(len(kriteria))] for _ in range(len(alternatif))]

    def get_nilai_penilaian(self, id_alternatif, id_kriteria, tahun, bulan):
        for penilaian in self.get_penilaian(tahun, bulan):
            if penilaian[1] == id_alternatif and penilaian[2] == id_kriteria:
                return penilaian[3]
        return None

    def matriks_penilaian(self, tahun, bulan):
        kriteria = self.get_kriteria()
        alternatif = self.get_alternatif()
        matriks_nilai = self.init_matriks_nilai()
        for i, a in enumerate(alternatif):
            for j, k in enumerate(kriteria):
                nilai_penilaian = self.get_nilai_penilaian(i + 1, j + 1, tahun, bulan)
                matriks_nilai[i][j] = nilai_penilaian
        return matriks_nilai

    def normalize_matriks(
        self,
        kriteria,
        alternatif,
        jenis_kriteria,
        matriks_penilaian,
        nilai_min,
        nilai_max,
    ):
        matriks_normalisasi = []
        for i, a in enumerate(alternatif):
            matriks_normalisasi.append([])
            for j, k in enumerate(kriteria):
                matriks_normalisasi[i].append(0)
                if jenis_kriteria[j] == "benefit":
                    matriks_normalisasi[i][j] = matriks_penilaian[i][j] / (
                        nilai_max[j] + 1
                    )
                else:
                    matriks_normalisasi[i][j] = nilai_min[j] / (
                        matriks_penilaian[i][j] + 1
                    )
        return matriks_normalisasi

    def get_max_min(self, matriks_penilaian, kriteria, alternatif):
        nilai_max, nilai_min = [], []
        for i, k in enumerate(kriteria):
            nilai_max.append(0)
            nilai_min.append(0)
            for j, a in enumerate(alternatif):
                if (j == 0) or (nilai_max[i] < matriks_penilaian[j][i]):
                    nilai_max[i] = matriks_penilaian[j][i]
                if (j == 0) or (nilai_min[i] > matriks_penilaian[j][i]):
                    nilai_min[i] = matriks_penilaian[j][i]
        return nilai_max, nilai_min

    def save_norm_to_db(self, alternatif, kriteria, norm_data):
        query_select = (
            "SELECT id FROM normalisasi WHERE alternatif_id = %s AND kriteria_id = %s"
        )
        query_update = "UPDATE normalisasi SET nilai = %s WHERE id = %s"
        query_insert = "INSERT INTO normalisasi (alternatif_id, kriteria_id, nilai) VALUES (%s, %s, %s)"

        for i, a in enumerate(alternatif):
            for j, k in enumerate(kriteria):
                select_data = (i + 1, j + 1)
                existing_result = self.db.execute_query_return_one(
                    query_select, select_data
                )
                if existing_result:
                    update_data = (norm_data[i][j], existing_result[0])
                    self.db.execute_query(query_update, update_data)
                else:
                    insert_data = (i + 1, j + 1, norm_data[i][j])
                    self.db.execute_query(query_insert, insert_data)
        self.db.commit()
        print("Norm saved to database")

    def nilai_q1(self, alternatif, kriteria, matriks_normalisasi, bobot):
        jumlah_kali = []
        for i, a in enumerate(alternatif):
            jumlah_kali.append(0)
            for j, k in enumerate(kriteria):
                jumlah_kali[i] += matriks_normalisasi[i][j] * bobot[j]
        return jumlah_kali

    def save_q1_to_db(self, alternatif, nilai_q1):
        query_select = "SELECT id FROM jumlah_kali WHERE alternatif_id = %s"
        query_update = "UPDATE jumlah_kali SET nilai = %s WHERE id = %s"
        query_insert = "INSERT INTO jumlah_kali (alternatif_id, nilai) VALUES (%s, %s)"

        for i, a in enumerate(alternatif):
            select_data = (i + 1,)
            existing_result = self.db.execute_query_return_one(
                query_select, select_data
            )
            if existing_result:
                update_data = (nilai_q1[i], existing_result[0])
                self.db.execute_query(query_update, update_data)
            else:
                insert_data = (i + 1, nilai_q1[i])
                self.db.execute_query(query_insert, insert_data)
        self.db.commit()
        print("Jumlah kali saved to database")

    def nilai_q2(self, alternatif, kriteria, matriks_normalisasi, bobot):
        kali_pangkat = []
        for i, a in enumerate(alternatif):
            kali_pangkat.append(1)
            for j, k in enumerate(kriteria):
                kali_pangkat[i] *= matriks_normalisasi[i][j] ** bobot[j]
        return kali_pangkat

    def save_q2_to_db(self, alternatif, nilai_q2):
        query_select = "SELECT id FROM kali_pangkat WHERE alternatif_id = %s"
        query_update = "UPDATE kali_pangkat SET nilai = %s WHERE id = %s"
        query_insert = "INSERT INTO kali_pangkat (alternatif_id, nilai) VALUES (%s, %s)"

        for i, a in enumerate(alternatif):
            select_data = (i + 1,)
            existing_result = self.db.execute_query_return_one(
                query_select, select_data
            )

            if existing_result:
                update_data = (nilai_q2[i], existing_result[0])
                self.db.execute_query(query_update, update_data)
            else:
                insert_data = (i + 1, nilai_q2[i])
                self.db.execute_query(query_insert, insert_data)
        self.db.commit()
        print("Kali pangkat saved to database")

    def hasil_akhir_waspas(self, alternatif, nilai_q1, nilai_q2):
        hasil_akhir = []
        for i, a in enumerate(alternatif):
            hasil_akhir.append(0)
            hasil_akhir[i] = (0.5 * nilai_q1[i]) + (0.5 * nilai_q2[i])
        return hasil_akhir

    def save_hasil_akhir_to_db(self, alternatif, hasil_akhir):
        query_select = "SELECT id FROM hasil_spk WHERE alternatif_id = %s"
        query_update = "UPDATE hasil_spk SET nilai = %s WHERE id = %s"
        query_insert = "INSERT INTO hasil_spk (alternatif_id, nilai) VALUES (%s, %s)"

        for i, a in enumerate(alternatif):
            select_data = (i + 1,)
            existing_result = self.db.execute_query_return_one(
                query_select, select_data
            )

            if existing_result:
                update_data = (hasil_akhir[i], existing_result[0])
                self.db.execute_query(query_update, update_data)
            else:
                insert_data = (i + 1, hasil_akhir[i])
                self.db.execute_query(query_insert, insert_data)
        self.db.commit()
        print("Hasil akhir saved to database")

    def alternatif_ranking(self, alternatif, hasil_akhir):
        alternatif_rank = []
        hasil_akhir_rank = []
        for i, a in enumerate(alternatif):
            alternatif_rank.append(a[i])
            hasil_akhir_rank.append(hasil_akhir[i])

        for i, a in enumerate(alternatif):
            for j, al in enumerate(alternatif):
                if j > i:
                    if hasil_akhir_rank[i] < hasil_akhir_rank[j]:
                        tmp_alternatif = alternatif_rank[i]
                        tmp_hasil_akhir = hasil_akhir_rank[i]
                        alternatif_rank[i] = alternatif_rank[j]
                        hasil_akhir_rank[i] = hasil_akhir_rank[j]
                        alternatif_rank[j] = tmp_alternatif
                        hasil_akhir_rank[j] = tmp_hasil_akhir
                        # without temp var
                        # experiment only
                        # alternatif_rank[i], alternatif_rank[j] = (
                        #     alternatif_rank[j],
                        #     alternatif_rank[i],
                        # )
                        # hasil_akhir_rank[i], hasil_akhir_rank[j] = (
                        #     hasil_akhir_rank[j],
                        #     hasil_akhir_rank[i],
                        # )

        return alternatif_rank, hasil_akhir_rank

    def nilai_waspas(self, tahun, bulan):
        kriteria = self.get_kriteria()
        alternatif = self.get_alternatif()
        matriks_nilai = self.matriks_penilaian(tahun, bulan)
        jenis_kriteria, bobot = self.get_bobot_jenis_kriteria()
        nilai_max, nilai_min = self.get_max_min(matriks_nilai, kriteria, alternatif)

        matriks_normalisasi = self.normalize_matriks(
            kriteria, alternatif, jenis_kriteria, matriks_nilai, nilai_min, nilai_max
        )
        self.save_norm_to_db(alternatif, kriteria, matriks_normalisasi)

        jumlah_kali = self.nilai_q1(alternatif, kriteria, matriks_normalisasi, bobot)
        self.save_q1_to_db(alternatif, jumlah_kali)

        kali_pangkat = self.nilai_q2(alternatif, kriteria, matriks_normalisasi, bobot)
        self.save_q2_to_db(alternatif, kali_pangkat)

        hasil_akhir = self.hasil_akhir_waspas(alternatif, jumlah_kali, kali_pangkat)
        self.save_hasil_akhir_to_db(alternatif, hasil_akhir)

        alternatif_rank, hasil_akhir_rank = self.alternatif_ranking(
            alternatif, hasil_akhir
        )

        return (
            alternatif,
            matriks_normalisasi,
            jumlah_kali,
            kali_pangkat,
            hasil_akhir,
            alternatif_rank,
            hasil_akhir_rank,
        )

    def konfersi_status(self, index, jumlah_penerima):
        if index < jumlah_penerima:
            return "Menerima"
        else:
            return "Tidak Menerima"

    def waspas(self, periode):
        (
            alternatif,
            matriks_normalisasi,
            jumlah_kali,
            kali_pangkat,
            hasil_akhir,
            alternatif_rank,
            hasil_akhir_rank,
        ) = self.nilai_waspas(2021, 5)

        status_array = [
            self.konversi_status(nilai_akhir, i, self.is_penerima())
            for i, nilai_akhir in enumerate(hasil_akhir_rank)
        ]

        self.save_penerima_to_db(
            alternatif, alternatif_rank, hasil_akhir_rank, status_array, periode
        )

        self.db.close()
        print("WASPAS calculation done")

    def save_penerima_to_db(
        self, alternatif, alternatif_rank, hasil_akhir_rank, status_array, periode
    ):
        query_select = "SELECT id FROM penerima WHERE alternatif_id = %s AND DATE_FORMAT(created_at, '%%Y-%%m') = %s"
        query_update = "UPDATE penerima SET nilai = %s, status = %s WHERE alternatif_id = %s AND DATE_FORMAT(created_at, '%%Y-%%m') = %s"
        query_insert = "INSERT INTO penerima (alternatif_id, nilai, status, created_at) VALUES (%s, %s, %s, %s)"

        periode_datetime = f"{periode}-01 00:00:00"
        for i, a in enumerate(alternatif):
            select_data = (alternatif_rank[i][0], periode)
            existing_result = self.db.execute_query_return_one(
                query_select, select_data
            )

            if existing_result:
                update_data = (
                    hasil_akhir_rank[i],
                    status_array[i],
                    alternatif_rank[i][0],
                    periode,
                )
                self.db.execute_query(query_update, update_data)
            else:
                insert_data = (
                    alternatif_rank[i][0],
                    hasil_akhir_rank[i],
                    status_array[i],
                    periode_datetime,
                )
                self.db.execute_query(query_insert, insert_data)
        self.db.commit()
        print("Penerima saved to database")
