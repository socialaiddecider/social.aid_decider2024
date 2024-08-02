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
                        <div id="accept" x-data="{ modelOpen: false }">
                            <button @click="modelOpen =!modelOpen"
                                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-primary-500 rounded-md dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:bg-primary-700 hover:bg-primary-600 focus:outline-none focus:bg-primary-500 focus:ring focus:ring-primary-300 focus:ring-opacity-50 stroke-neutral-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-inherit">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                </svg>
                                <span>Diterima</span>
                            </button>

                            <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                                role="dialog" aria-modal="true">
                                <div
                                    class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                    <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                        x-transition:enter="transition ease-out duration-300 transform"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-200 transform"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                                        aria-hidden="true"></div>

                                    <div x-cloak x-show="modelOpen"
                                        x-transition:enter="transition ease-out duration-300 transform"
                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave="transition ease-in duration-200 transform"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                        <div class="flex items-center justify-between space-x-4">
                                            <h1 class="text-xl font-medium text-gray-800 ">Menerima pengajuan user</h1>

                                            <button @click="modelOpen = false"
                                                class="text-gray-600 focus:outline-none hover:text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </div>

                                        <p class="mt-2 text-sm text-gray-500 ">
                                            Menerima pengajuan dari <span
                                                class="text-primary-500">{{ $pengajuan->name }}</span> pada tanggal
                                            <span
                                                class="text-primary-500">{{ $pengajuan->created_at->format('M, d Y') }}</span>
                                        </p>

                                        <form action="{{ route($updateLocation, $pengajuan->pengajuan_id) }}" method="POST"
                                            class="mt-3 flex justify-end">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="status" value="save" hidden>
                                            <button type="submit"
                                                class="w-fit px-4 rounded-lg py-2 bg-primary-500 inline-flex items-center gap-1 ">
                                                <div class="icon stroke-neutral-50 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6 stroke-inherit">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                                    </svg>
                                                </div>
                                                <span class="text-neutral-50 text-lg font-semibold">Terima</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="decline" x-data="{ modelOpen: false }">
                            <button @click="modelOpen =!modelOpen"
                                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-error-500 rounded-md dark:bg-error-600 dark:hover:bg-error-700 dark:focus:bg-error-700 hover:bg-error-600 focus:outline-none focus:bg-error-500 focus:ring focus:ring-error-300 focus:ring-opacity-50 stroke-neutral-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-inherit">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9" />
                                </svg>

                                <span>Ditolak</span>
                            </button>

                            <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto"
                                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div
                                    class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                    <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                        x-transition:enter="transition ease-out duration-300 transform"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-200 transform"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                                        aria-hidden="true"></div>

                                    <div x-cloak x-show="modelOpen"
                                        x-transition:enter="transition ease-out duration-300 transform"
                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave="transition ease-in duration-200 transform"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                        <div class="flex items-center justify-between space-x-4">
                                            <h1 class="text-xl font-medium text-gray-800 ">Tolak pengajuan user</h1>

                                            <button @click="modelOpen = false"
                                                class="text-gray-600 focus:outline-none hover:text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </div>

                                        <p class="mt-2 text-sm text-gray-500 ">
                                            Menolak pengajuan dari <span
                                                class="text-error-500">{{ $pengajuan->name }}</span> pada tanggal
                                            <span
                                                class="text-error-500">{{ $pengajuan->created_at->format('M, d Y') }}</span>
                                        </p>

                                        <form action="{{ route($updateLocation, $pengajuan->pengajuan_id) }}"
                                            method="POST" class="mt-3 flex justify-end">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="status" value="remove" hidden>
                                            <button type="submit"
                                                class="w-fit px-4 rounded-lg py-2 bg-error-500 inline-flex items-center gap-1 ">
                                                <div class="icon stroke-neutral-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6 stroke-inherit">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9" />
                                                    </svg>
                                                </div>
                                                <span class="text-neutral-50 text-lg font-semibold">Ditolak</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
