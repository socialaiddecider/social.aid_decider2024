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
