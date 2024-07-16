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
        <div class="content-body p-4 bg-neutral-50 rounded-2xl relative">
            <div class="table w-full">
                <div class="header-table flex justify-between items-center mb-6">
                    <div class="header-title">
                        <h1 class="text-2xl font-semibold">Masukkan Data Subkriteria</h1>
                    </div>

                </div>
                <div class="table-wrap">
                    <div class="relative">
                        <table class="w-full table-auto">
                            <thead class="border-b-2 bg-neutral-50">
                                <tr class="">
                                    <th class="px-6 py-4 text-start text-sm font-semibold">No</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Kode Kriteria</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Nama</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Jenis</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Bobot</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @php
                                    $styleJenis = [
                                        'cost' => 'bg-rose-200 text-rose-500',
                                        'benefit' => 'bg-primary-200 text-primary-500',
                                    ];
                                @endphp
                                @foreach ($kriteria as $key => $item)
                                    <tr class="">

                                        <td class="px-6 py-4 text-sm">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 text-sm w-fit">{{ $item->kode_kriteria }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $item->nama }}</td>
                                        <td class="px-6 py-4 text-sm ">
                                            <span
                                                class="px-4 py-1 rounded-full capitalize font-semibold {{ $item->jenis == 'benefit' ? $styleJenis['benefit'] : $styleJenis['cost'] }}">{{ $item->jenis }}</span>

                                        </td>
                                        <td class="px-6 py-4 text-sm">{{ $item->bobot }}</td>
                                        <td class="px-6 py-4 text-sm inline-flex">
                                            <a href="{{ route($detailLocation, $item->id) }}"
                                                class="flex gap-2 p-2 bg-primary-200 hover:bg-primary-base transition-all ease-in-out rounded-lg hover:text-neutral-50 text-primary-base hover:stroke-neutral-50 stroke-primary-base">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                                    viewBox="0 0 25 24" fill="none" class="stroke-inherit">
                                                    <path
                                                        d="M11 6h9.75M11 6a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0M4.25 6H8m3 12h9.75M11 18a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H8m9-6h3.75M17 12a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0H14"
                                                        stroke="inherit" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <span class="text-inherit font-semibold">Subkriteria</span>
                                            </a>
                                        </td>
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
