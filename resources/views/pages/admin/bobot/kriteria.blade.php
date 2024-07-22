@extends('layouts.admin.sidebar')

@section('contents-admin')
    <section class="kriteria py-6 px-8 overflow-y-auto no-scrollbar ">
        <div class="header mb-6">
            <div class="wrap flex justify-between">
                <div class="title text-2xl font-semibold">
                    <h1 class="">{{ $title }}</h1>
                </div>
                <div class="action">
                    <x-sort-button :sortable="$sortable"></x-sort-button>
                </div>
            </div>
        </div>
        <div class="content-body grid grid-cols-3 gap-2">
            <div class=" p-4 bg-neutral-50 rounded-2xl relative">
                <div class="header-table flex justify-between items-center mb-6">
                    <div class="header-title">
                        <h1 class="text-2xl font-semibold">Menghitung Bobot Kriteria</h1>
                    </div>

                </div>
                <div class="content wrap">
                    <div class="relative">
                        <form action="{{ $calcLocation }}" method="POST">
                            @csrf
                            <div class="form-body mb-4">
                                <x-input-form key="periode" title="Periode Perhitungan" type="date"
                                    placeholder="periode hitungan" />
                                <x-input-form key="iteration" title="Iterasi Perhitungan" type="text"
                                    placeholder="contoh: 8" />
                                <x-input-form key="popsize" title="Popsize Perhitungan" type="text"
                                    placeholder="contoh: 12" />
                                <x-input-form key="crossover_rate" title="Crossover Rate (CR) Perhitungan" type="text"
                                    placeholder="contoh: 0.3" />
                                <x-input-form key="mutation_rate" title="Mutation Rate (MR) Perhitungan" type="text"
                                    placeholder="contoh: 0.7" />
                                <x-input-form key="sum_penerima" title="Jumlah Penerima Perhitungan" type="text"
                                    placeholder="contoh: 26" />
                            </div>

                            <div class="form-action flex justify-end">
                                <button type="submit"
                                    class="btn bg-primary-base text-white transition-all duration-200 px-6 py-3 font-semibold rounded-lg">Hitung
                                    Bobot Kriteria</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            <div class="col-span-2 p-4 bg-neutral-50 rounded-2xl relative">
                <div class="header-table flex justify-between items-center mb-6">
                    <div class="header-title">
                        <h1 class="text-2xl font-semibold">Hasil Bobot Kriteria</h1>
                    </div>
                    <div class="header-action">
                        <a href="{{ $saveLocation }}"
                            class="btn bg-primary-base text-white transition-all duration-200 px-6 py-3 font-semibold rounded-lg">Simpan
                            Bobot</a>
                    </div>
                </div>
                <div class="content wrap">
                    <div class="relative">
                        <table class="w-full table-auto">
                            <thead class="border-b-2 bg-neutral-50">
                                <tr class="">
                                    <th class="px-4 py-4 text-start text-sm font-semibold">No</th>
                                    <th class="px-4 py-4 text-start text-sm font-semibold w-fit">Kode Kriteria</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Nama</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Bobot</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($bobot as $key => $item)
                                    <tr class="">
                                        <td class="px-6 py-4 text-sm ">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-4 text-sm w-fit">{{ $item->kode_kriteria }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $item->nama }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $item->bobot }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
