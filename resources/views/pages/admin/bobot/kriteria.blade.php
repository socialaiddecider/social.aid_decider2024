@extends('layouts.admin.sidebar')

@section('contents-admin')
    <section class="kriteria py-6 px-8 overflow-y-auto no-scrollbar ">
        <div class="header mb-6">
            <div class="wrap flex justify-between">
                <div class="title text-2xl font-semibold">
                    <h1 class="">{{ $title }}</h1>
                </div>
                <div class="action">
                    <button class="button flex gap-2 bg-neutral-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.6875 8.15954C3.05174 8.49776 3.6212 8.47667 3.95942 8.11243L6.29991 5.59191L6.29991 15.9C6.29991 16.3971 6.70285 16.8 7.19991 16.8C7.69696 16.8 8.09991 16.3971 8.09991 15.9V5.59191L10.4404 8.11243C10.7786 8.47667 11.3481 8.49776 11.7123 8.15954C12.0766 7.82132 12.0976 7.25186 11.7594 6.88762L7.85942 2.68762C7.68913 2.50423 7.45017 2.40002 7.19991 2.40002C6.94964 2.40002 6.71068 2.50423 6.54039 2.68762L2.64039 6.88762C2.30217 7.25186 2.32326 7.82132 2.6875 8.15954ZM12.2875 15.8405C11.9233 16.1787 11.9022 16.7482 12.2404 17.1124L16.1404 21.3124C16.3107 21.4958 16.5496 21.6 16.7999 21.6C17.0502 21.6 17.2891 21.4958 17.4594 21.3124L21.3594 17.1124C21.6976 16.7482 21.6765 16.1787 21.3123 15.8405C20.9481 15.5023 20.3786 15.5234 20.0404 15.8876L17.6999 18.4081V8.10003C17.6999 7.60297 17.297 7.20003 16.7999 7.20003C16.3028 7.20003 15.8999 7.60297 15.8999 8.10003V18.4081L13.5594 15.8876C13.2212 15.5234 12.6517 15.5023 12.2875 15.8405Z"
                                fill="#7F7F7F" />
                        </svg>
                        <h6>Sort</h6>
                    </button>
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
                        <form action="{{ 'data' }}" method="POST">
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
                                        <td class="px-6 py-4 text-sm ">{{ $key + 1 }}</td>
                                        <td class="px-4 py-4 text-sm w-fit">{{ $item->kriteria->kode_kriteria }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $item->kriteria->nama }}</td>
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
