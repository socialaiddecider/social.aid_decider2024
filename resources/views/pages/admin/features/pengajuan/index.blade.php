@extends('layouts.admin.sidebar')

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
                <div class="header-table flex justify-between items-center mb-6">
                    <div class="header-title">
                        <h1 class="text-2xl font-semibold">Data Pengaduan yang diajukan</h1>
                    </div>
                    <div class="header-action">

                    </div>
                </div>
                <div class="table-wrap" x-data="itemSelected" x-effect="$data.elementUpdate()">
                    <div class="relative">
                        <table class="w-full table-auto">
                            <thead class="border-b-2 bg-neutral-50">
                                <tr class="">
                                    <th class="px-6 py-4 w-1 text-start">
                                        <div id="checkbox" class="inline-flex gap-2 items-center ">
                                            <label class="relative rounded-full cursor-not-allowed flex items-center">
                                                <input id="check-box" type="checkbox"
                                                    class="peer relative h-4 w-4 cursor-not-allowed appearance-none rounded-sm border border-primary-200 transition-all  checked:border-primary-base checked:bg-primary-base"
                                                    name="check-box" disabled />
                                                <span
                                                    class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5"
                                                        viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                        stroke-width="1">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </label>

                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">No</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">NKK</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Nama</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">status</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Tanggal</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @php
                                    $statusStyle = [
                                        'pending' => 'bg-blue-200 text-blue-500',
                                        'approved' => 'bg-primary-200 text-primary-500',
                                        'rejected' => 'bg-error-200 text-error-500',
                                    ];
                                @endphp
                                @foreach ($pengajuan as $key => $item)
                                    <tr class="">
                                        <td class="px-6 py-4 relative z-30">
                                            <div id="checkbox" class="inline-flex gap-2 items-center">
                                                <label class="relative rounded-full cursor-pointer flex items-center">
                                                    <input id="check-box-{{ $item->id }}" type="checkbox"
                                                        class="peer relative h-4 w-4 cursor-pointer appearance-none rounded-sm border border-primary-200 transition-all  checked:border-primary-base checked:bg-primary-base"
                                                        name="check-box-{{ $item->id }}"
                                                        @change="toggleCheckbox(event)" />
                                                    <span
                                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5"
                                                            viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                            stroke-width="1">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 text-sm  w-64">{{ $item->nkk }}</td>
                                        <td class="px-6 py-4 text-sm ">{{ $item->name }}</td>
                                        <td class="px-6 py-4 text-sm"><span
                                                class="px-4 py-1 rounded-full font-semibold {{ $statusStyle[$item->status] }}">{{ $item->status }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm w-24">
                                            {{ date_format($item->created_at, 'H.i, d-m-Y ') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm inline-flex">
                                            <a href="{{ route($showLocation, $item->pengajuan_id) }}" class="p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0m-9-3.75h.008v.008H12z" />
                                                </svg>
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
