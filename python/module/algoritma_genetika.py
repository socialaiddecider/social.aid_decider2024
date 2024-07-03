#!usr/bin/python3

import module.db as db
import module.waspas as waspas
import numpy as np
import random


class algoritma_genetika:
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

    def get_algoritma_genetika(self):
        algoritma_genetika = self.db.get_all_data_from_table("algoritma_genetika")
        return algoritma_genetika

    def get_penilaian(self, tahun, bulan):
        query = "SELECT * FROM penilaian WHERE YEAR(created_at) = %s AND MONTH(created_at) = %s"
        data = (tahun, bulan)
        penilaian = self.db.execute_query_return_all(query, data)
        return penilaian

    def get_real_data_by_period_in_database(self, tahun, bulan):
        query_select = "SELECT data_asli.*, alternatif.kode_alternatif FROM data_asli JOIN alternatif ON data_asli.alternatif_id = alternatif.id WHERE YEAR(data_asli.created_at) = %s AND MONTH(data_asli.created_at) = %s"
        select_data = (tahun, bulan)
        data = self.db.execute_query_return_all(query_select, select_data)
        return data

    def get_real_data(self, tahun, bulan):
        database_data = self.get_real_data_by_period_in_database(tahun, bulan)
        real_data = {}
        for data in database_data:
            kode_alternatif = data[5]
            status = data[2]
            real_data[kode_alternatif] = status

        return real_data

    def init_jenis_kriteria_bobot_jumlah_penerima(self):
        jenis_kriteria = []
        bobot = []
        for kriteria in self.get_kriteria():
            jenis_kriteria.append(kriteria[3])
            bobot.append(kriteria[4])
        jumlah_penerima = self.get_jumlah_penerima()[0][5]

        return jenis_kriteria, bobot, jumlah_penerima

    def init_matriks(self, kriteria, alternatif):
        return [[0 for _ in range(len(kriteria))] for _ in range(len(alternatif))]

    def get_nilai_penilaian(self, alternatif_id, kriteria_id, tahun, bulan):
        for p in self.get_penilaian(tahun, bulan):
            if p[1] == alternatif_id and p[2] == kriteria_id:
                return p[3]
        return None

    def penilaian_proses(self, alternatif, kriteria, tahun, bulan):
        matriks = self.init_matriks(kriteria, alternatif)
        for i, a in enumerate(alternatif):
            for j, k in enumerate(kriteria):
                matriks[i][j] = self.get_nilai_penilaian(i + 1, j + 1, tahun, bulan)
        return matriks

    def hitung_akurasi(
        self, real_data, alternatif_rank, hasil_akhir_rank, jumlah_penerima
    ):
        status_array = [
            self.waspas.konversi_status(nilai_akhir, i, jumlah_penerima)
            for i, nilai_akhir in enumerate(hasil_akhir_rank)
        ]

        for i in range(len(hasil_akhir_rank)):
            status_array[i]

        sesuai = 0
        for i in range(len(hasil_akhir_rank)):
            if status_array[i] == real_data[alternatif_rank[i][1]]:
                sesuai += 1

        akurasi = (sesuai / len(alternatif_rank)) * 100 / 100

        return akurasi

    def fitness(self, real_data, tahun, bulan):

        (
            matriks_normalisasi,
            jumlah_kali,
            kali_pangkat,
            hasil_akhir,
            alternatif_rank,
            hasil_akhir_rank,
        ) = self.waspas.nilai_waspas(tahun, bulan)
        return [
            self.waspas.hitung_akurasi(real_data, alternatif_rank, hasil_akhir_rank)
        ]

    def crossover(self, sol_per_pop, population):
        offspring = []
        crossover_rate = self.get_algoritma_genetika()[0][3]
        num_crossovers = crossover_rate * sol_per_pop

        if num_crossovers - int(num_crossovers) >= 0.5:
            loop_crossovers = int(num_crossovers) + 1
        else:
            loop_crossovers = int(num_crossovers)

        for _ in range(loop_crossovers):
            parent1 = population[np.random.randint(0, population.shape[0])]
            parent2 = population[np.random.randint(0, population.shape[0])]

            while np.array_equal(parent1, parent2):
                parent2 = population[np.random.randint(0, population.shape[0])]

            beta = np.random.rand(parent1.shape[0])

            offspring_new = (beta * (parent1 - parent2)) + parent1

            offspring_new = np.abs(offspring_new)

            offspring_new /= np.sum(offspring_new)  # Normalisasi offspring

            offspring.append(offspring_new)

        return np.array(offspring)

    def mutation(self, sol_per_pop, population):
        offspring = []
        min_value = 0.01
        max_value = 0.99

        mutation_rate = self.get_algoritma_genetika()[0][4]
        num_mutations = mutation_rate * sol_per_pop

        if num_mutations - int(num_mutations) >= 0.5:
            loop_mutations = int(num_mutations) + 1
        else:
            loop_mutations = int(num_mutations)

        for _ in range(loop_mutations):
            random_chromosome_idx = np.random.randint(0, population.shape[0])
            random_gene_idx = np.random.choice(range(population.shape[1]))

            r = np.random.rand()
            if r < 0.5:
                population[random_chromosome_idx, random_gene_idx] = min_value
            else:
                population[random_chromosome_idx, random_gene_idx] = max_value

            offspring.append(population[random_chromosome_idx])

        return np.array(offspring)

    def parent_selection(
        self, combined_fitness, num_parents, combined_population, population
    ):
        fitness_sorted = sorted(
            range(len(combined_fitness)),
            key=lambda k: combined_fitness[k],
            reverse=True,
        )

        parents = np.empty((num_parents, population.shape[1]))
        selected_fitness = np.zeros(num_parents)

        for parent_num in range(num_parents):
            parent_index = fitness_sorted[parent_num]
            parents[parent_num, :] = combined_population[parent_index].copy()
            selected_fitness[parent_num] = combined_fitness[parent_index]

        return parents, selected_fitness

    def get_random_values(self, num_genes, init_range_low, init_range_high):
        values = [
            random.uniform(init_range_low, init_range_high) for _ in range(num_genes)
        ]

        total = sum(values)
        normalized_values = [value / total for value in values]

        return normalized_values

    def save_best_individual_to_database(self, best_individual):
        query_select = "SELECT id, kode_kriteria FROM kriteria"
        query_select_2 = "SELECT id FROM bobot WHERE kriteria_id = %s"
        query_update = "UPDATE bobot SET bobot = %s WHERE kriteria_id = %s"
        query_insert = "INSERT INTO bobot (kriteria_id, bobot) VALUES (%s, %s)"

        kriteria_info = self.db.execute_query_return_all(query_select)

        values_to_insert = []

        for i, bobot in enumerate(best_individual):
            kriteria_id = None
            kode_kriteria = f"C{i+1}"

            for kriteria in kriteria_info:
                if kriteria[1] == kode_kriteria:
                    kriteria_id = kriteria[0]
                    break

            existing_entry = self.db.execute_query_return_one(
                query_select_2, (kriteria_id,)
            )

            if existing_entry:
                update_data = (round(bobot, 3), kriteria_id)
                self.db.execute_query(query_update, update_data)
            else:
                values_to_insert.append((kriteria_id, round(bobot, 3)))

        self.db.conn.executemany(query_insert, values_to_insert)
        self.db.conn.commit()

    def genetics_algorithm(self, tahun, bulan):
        kriteria = self.get_kriteria()
        subkriteria = self.get_subkriteria()
        alternatif = self.get_alternatif()
        penilaian = self.get_penilaian(tahun, bulan)
        real_data = self.get_real_data(tahun, bulan)
        algoritma_genetika = self.get_algoritma_genetika()

        jenis_kriteria, bobot, jumlah_penerima = (
            self.init_jenis_kriteria_bobot_jumlah_penerima()
        )
        matriks_nilai = self.penilaian_proses(alternatif, kriteria, tahun, bulan)

        num_generations = algoritma_genetika[0][1]
        sol_per_pop = algoritma_genetika[0][2]
        num_genes = len(kriteria)
        init_range_low = 0
        init_range_high = 1

        population = [
            self.get_random_values(num_genes, init_range_low, init_range_high)
            for _ in range(sol_per_pop)
        ]
        population = np.array(population)

        for generation in range(num_generations):
            fitness_values = [
                self.fitness(individual, tahun, bulan) for individual in population
            ]

            offspring_crossover = self.crossover(sol_per_pop, population)

            offspring_mutation = self.mutation(sol_per_pop, population)

            crossover_fitness = [
                self.fitness(individual, tahun, bulan)
                for individual in offspring_crossover
            ]

            mutated_fitness = [
                self.fitness(individual, tahun, bulan)
                for individual in offspring_mutation
            ]

            combined_fitnes = np.array(
                fitness_values + crossover_fitness + mutated_fitness
            )

            combined_population = np.concatenate(
                (population, offspring_crossover, offspring_mutation), axis=0
            )

            elite_parents = self.parent_selection(
                combined_fitnes, sol_per_pop, combined_population, population
            )

            elite_population = elite_parents[0]
            population = elite_population.copy()

            best_individual = max(population, key=self.fitness())
            best_fitness = self.fitness(best_individual, tahun, bulan)

            self.save_best_individual_to_database(best_individual)
