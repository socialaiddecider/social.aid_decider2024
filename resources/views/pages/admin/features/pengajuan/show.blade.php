@extends('layouts.admin.sidebar')
@php
    $statusStyle = [
        'pending' => 'bg-blue-200 text-blue-500',
        'approved' => 'bg-primary-200 text-primary-500',
        'rejected' => 'bg-error-200 text-error-500',
    ];
@endphp
@section('contents-admin')
    <section class="manage-pengajuan py-6 px-8 overflow-y-auto no-scrollbar min-h-screen">
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
                <div class="header-table flex justify-between items-center mb-2">
                    <div class="header-title">
                        <h1 class="text-2xl font-semibold">Data Detail Penilaian</h1>
                    </div>
                </div>
                <div class="information mb-5 ms-4 flex justify-between">
                    <div class="detail-information flex gap-10">
                        <div class="">
                            <div class="flex flex-col gap-1">
                                <h1 class="font-semibold">Nama Pemohon</h1>
                                <h3>{{ $pengajuan->name }}</h3>
                            </div>
                            <div class="flex flex-col gap-1">
                                <h1 class="font-semibold">Tanggal Pengajuan</h1>
                                <h3>{{ $pengajuan->created_at->format('M, d Y') }}</h3>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1 class="font-semibold">Status</h1>
                            <h3 class="px-4 py-1 w-fit rounded-full font-semibold {{ $statusStyle[$pengajuan->status] }}">
                                <span class="">{{ $pengajuan->status }}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="action px-4 flex gap-2 flex-row-reverse">
                        <div class="accept">
                            <form action="{{ route($updateLocation, $pengajuan->pengajuan_id) }}" method="POST"
                                class="px-4 py-2 bg-primary-500 inline-flex items-center rounded-lg">
                                @csrf
                                @method('PUT')
                                <input type="text" name="status" value="save" hidden>
                                <button type="submit" class="inline-flex items-center gap-1 ">
                                    <div class="icon stroke-neutral-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6 stroke-inherit">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                        </svg>
                                    </div>
                                    <span class="text-neutral-50 text-lg font-semibold">Terima</span>
                                </button>
                            </form>
                        </div>
                        <div class="decline">
                            <form action="{{ route($updateLocation, $pengajuan->pengajuan_id) }}" method="POST"
                                class="px-4 py-2 bg-error-500  inline-flex items-center rounded-lg">
                                @csrf
                                @method('PUT')
                                <input type="text" name="status" value="remove" hidden>
                                <button type="submit" class="inline-flex items-center gap-1 ">
                                    <div class="icon stroke-neutral-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6 stroke-inherit">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                        </svg>
                                    </div>
                                    <span class="text-neutral-50 text-lg font-semibold">Ditolak</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-wrap">
                    <div class="relative">
                        <h2 class="text-xl font-medium">Pilihan Penilaian</h2>
                        <table class="w-full table-auto">
                            <thead class="border-b-2 bg-neutral-50">
                                <tr class="">
                                    <th class="px-6 py-4 text-start text-sm font-semibold">No</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Kode Kriteria</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Kriteria</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Penilaian</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Nilai</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Bobot</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @php
                                    $styleJenis = [
                                        'cost' => 'bg-rose-200 text-rose-500',
                                        'benefit' => 'bg-primary-200 text-primary-500',
                                    ];
                                @endphp
                                @foreach ($detailPengajuan as $key => $item)
                                    <tr class="">

                                        <td class="px-6 py-4 text-sm">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 text-sm w-fit">{{ $item->kode_kriteria }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $item->nama_kriteria }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $item->nama }}</td>
                                        <td class="px-6 py-4 text-sm ">
                                            {{ $item->nilai }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">{{ $item->bobot }}</td>
                                        <td class="px-6 py-4 text-sm inline-flex">

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
