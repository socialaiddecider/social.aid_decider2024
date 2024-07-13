@extends('layouts.admin.sidebar')

@php
    $monthName = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];
@endphp


@section('contents-admin')
    <section class="penilaian py-6 px-8 overflow-y-auto no-scrollbar min-h-screen">
        <div class="header mb-6 ">
            <div class="wrap flex justify-between">
                <div class="title text-2xl font-semibold">
                    <h1 class="">{{ $title }}</h1>
                </div>
                <div class="action inline-flex items-center gap-3">
                    <div class="sort">
                        <button class="button flex items-center gap-2 bg-neutral-50 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.6875 8.15954C3.05174 8.49776 3.6212 8.47667 3.95942 8.11243L6.29991 5.59191L6.29991 15.9C6.29991 16.3971 6.70285 16.8 7.19991 16.8C7.69696 16.8 8.09991 16.3971 8.09991 15.9V5.59191L10.4404 8.11243C10.7786 8.47667 11.3481 8.49776 11.7123 8.15954C12.0766 7.82132 12.0976 7.25186 11.7594 6.88762L7.85942 2.68762C7.68913 2.50423 7.45017 2.40002 7.19991 2.40002C6.94964 2.40002 6.71068 2.50423 6.54039 2.68762L2.64039 6.88762C2.30217 7.25186 2.32326 7.82132 2.6875 8.15954ZM12.2875 15.8405C11.9233 16.1787 11.9022 16.7482 12.2404 17.1124L16.1404 21.3124C16.3107 21.4958 16.5496 21.6 16.7999 21.6C17.0502 21.6 17.2891 21.4958 17.4594 21.3124L21.3594 17.1124C21.6976 16.7482 21.6765 16.1787 21.3123 15.8405C20.9481 15.5023 20.3786 15.5234 20.0404 15.8876L17.6999 18.4081V8.10003C17.6999 7.60297 17.297 7.20003 16.7999 7.20003C16.3028 7.20003 15.8999 7.60297 15.8999 8.10003V18.4081L13.5594 15.8876C13.2212 15.5234 12.6517 15.5023 12.2875 15.8405Z"
                                    fill="#7F7F7F" />
                            </svg>
                            <h6 class="text-sm font-medium text-neutral-500">Sort</h6>
                        </button>
                    </div>
                    <div class="get-by-month relative" x-data="{ isOpen: false }">
                        <button type="button" @click="isOpen= !isOpen"
                            class="p-3 divide-x-2 bg-neutral-50 rounded-xl flex items-center">
                            <div class="title flex items-center gap-2 px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.9 2.4a.9.9 0 0 1 .9.9v1.5h8.4V3.3a.9.9 0 1 1 1.8 0v1.5h.3a3.3 3.3 0 0 1 3.3 3.3v10.2a3.3 3.3 0 0 1-3.3 3.3H5.7a3.3 3.3 0 0 1-3.3-3.3V8.1a3.3 3.3 0 0 1 3.3-3.3H6V3.3a.9.9 0 0 1 .9-.9M5.7 9a1.5 1.5 0 0 0-1.5 1.5v7.8a1.5 1.5 0 0 0 1.5 1.5h12.6a1.5 1.5 0 0 0 1.5-1.5v-7.8A1.5 1.5 0 0 0 18.3 9z"
                                        fill="#7F7F7F" />
                                </svg>
                                <h3 class="text-sm font-medium text-neutral-500">
                                    {{ $tanggalAwal->format('d M') . '-' . $tanggalAkhir->format('d M') }}</h3>
                            </div>
                            <div class="filter flex items-center gap-2 px-2">
                                <h3 class="text-sm font-medium text-neutral-500">Monthly</h3>
                                <svg xmlns="http://www.w3.org/2000/svg" :class="isOpen ? 'rotate-180' : ''"
                                    class="transition-all duration-150" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.276 8.651a.9.9 0 0 1 1.273.025L12 13.402l4.451-4.726a.9.9 0 1 1 1.298 1.248l-5.1 5.4a.9.9 0 0 1-1.298 0l-5.1-5.4a.9.9 0 0 1 .025-1.273"
                                        fill="#7F7F7F" />
                                </svg>
                            </div>
                        </button>
                        <div class="absolute right-0 z-20 px-6 py-4 bg-neutral-50 rounded-xl top-14"
                            @click.away= "isOpen = false ; init()" x-show="isOpen" x-data="{
                                inputYear: 0,
                                year: 0,
                                month: 0,
                                urlParams: new URLSearchParams(window.location.search),
                                init() {
                                    if (this.urlParams.has('date')) {
                                        let date = this.urlParams.get('date').split('-');
                                        this.year = parseInt(date[0]);
                                        this.month = parseInt(date[1]);
                                        this.inputYear = this.year;
                                    } else {
                                        this.thisYear();
                                    }
                                },
                                thisYear() {
                                    let date = new Date();
                                    this.year = date.getFullYear();
                                    this.month = date.getMonth() + 1;
                                    this.inputYear = this.year;
                                },
                                checkYear() {
                                    if (this.inputYear < 0) {
                                        this.inputYear = this.year;
                                    }
                                    if (!isNaN(this.inputYear)) {
                                        this.year = this.inputYear;
                                    }
                                },
                                requestFilter() {
                                    console.log(this.year, this.month)
                                    this.urlParams.set('date', this.year + '-' + (this.month));
                                    window.location.search = this.urlParams;
                                }
                            
                            }"
                            x-effect="checkYear(); console.log($data.year,$data.inputYear,$data.month);">
                            <div class="year flex justify-between">
                                <div class="left" @click="inputYear += 1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" class="stroke-neutral-base"
                                        height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M15.75 19.5 8.25 12l7.5-7.5" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <input type="tel" inputmode="numeric" x-model="inputYear" size='2'
                                    x-on:focusout="if(year == ''){ $data.thisYear()}">
                                <div class="right" @click="inputYear -= 1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" class="stroke-neutral-base"
                                        height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="m8.25 4.5 7.5 7.5-7.5 7.5" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-96 grid grid-cols-3">
                                @foreach ($monthName as $index => $value)
                                    @php
                                        $index += 1;
                                    @endphp
                                    <div class="form-group relative" id="{{ $index }}">
                                        <div class="flex gap-10 ">
                                            <div class="inline-flex relative items-center px-2 ">
                                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                                    for="{{ $index }}">
                                                    <input name="month" type="radio"
                                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary-200 text-neutral-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-primary-500 before:opacity-0 before:transition-opacity checked:border-primary-base checked:before:bg-primary-base hover:before:opacity-10"
                                                        id="{{ $index }}" value="{{ $index }}"
                                                        x-model="month" />
                                                    <span
                                                        class="absolute text-primary-base transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                            viewBox="0 0 16 16" fill="currentColor">
                                                            <circle data-name="ellipse" cx="8" cy="8" r="8">
                                                            </circle>
                                                        </svg>
                                                    </span>
                                                </label>
                                                <label
                                                    class="mt-px font-light text-sm text-gray-700 cursor-pointer select-none"
                                                    for="{{ $index }}">
                                                    {{ $value }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="action-filter flex justify-end">
                                <button type="button" @click="requestFilter()"
                                    class="bg-primary-500 px-5 py-2 rounded-lg ">
                                    <h1 class="text-neutral-50">Terapkan</h1>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body p-4 bg-neutral-50 rounded-2xl relative">
            <div class="table w-full">
                <div class="header-table flex justify-between items-center mb-6">
                    <div class="header-title">
                        <h1 class="text-2xl font-semibold">Masukkan Data Penilaian</h1>
                    </div>
                    <div class="header-action">
                        <a href="{{ $addLocation }}"
                            class="bg-primary-base inline-flex p-3 rounded-lg gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 3.75C12.4142 3.75 12.75 4.08579 12.75 4.5V11.25H19.5C19.9142 11.25 20.25 11.5858 20.25 12C20.25 12.4142 19.9142 12.75 19.5 12.75H12.75V19.5C12.75 19.9142 12.4142 20.25 12 20.25C11.5858 20.25 11.25 19.9142 11.25 19.5V12.75H4.5C4.08579 12.75 3.75 12.4142 3.75 12C3.75 11.5858 4.08579 11.25 4.5 11.25H11.25V4.5C11.25 4.08579 11.5858 3.75 12 3.75Z"
                                    fill="white" />
                            </svg>
                            <h6 class="text-neutral-50 font-medium text-sm">Tambah Kriteria</h6>
                        </a>
                    </div>
                </div>
                <div class="table-wrap" x-data="itemSelected">
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
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Kode</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Alternatif</th>
                                    @foreach ($kriteria as $item)
                                        <th class="px-6 py-4 text-start text-sm font-semibold relative"
                                            x-data="{ show: false }">
                                            <h3 @mouseover="show=!show" @mouseleave="show=false">
                                                {{ $item->kode_kriteria }}
                                            </h3>
                                            <h6 class="text-xs absolute font-medium opacity-80 underline text-nowrap top-0"
                                                x-show="show">
                                                ({{ $item->nama }})
                                            </h6>
                                        </th>
                                    @endforeach
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($alternatif as $item)
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
                                        <td class="px-6 py-4 text-sm">{{ $item->kode_alternatif }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $item->nama }}</td>
                                        @php
                                            $penilaianDate = '';
                                        @endphp
                                        @foreach ($penilaian as $nilai)
                                            @if ($nilai->alternatif_id == $item->id)
                                                @php
                                                    $penilaianDate = $nilai->created_at;
                                                @endphp
                                                <td class="px-6 py-4 text-sm relative" x-data="{ over: false }"
                                                    @mouseover="over= !over" @mouseleave="over=false">{{ $nilai->nilai }}
                                                    <p x-show="over" class="absolute left-0 text-nowrap">
                                                        @foreach ($subkriteria as $sub)
                                                            @if ($sub->nilai == $nilai->nilai && $sub->kriteria_id == $nilai->kriteria_id)
                                                                {{ $sub->nama }}
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                </td>
                                            @endif
                                        @endforeach
                                        <td class="px-6 py-4 text-sm inline-flex">
                                            @php
                                                $penilaianDate = $penilaianDate->format('Y-m-d');
                                            @endphp
                                            <a href="{{ route($editLocation, [$penilaianDate, $item->id]) }}"
                                                class="p-2"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                    height="24" viewBox="0 0 25 24" fill="none">
                                                    <path
                                                        d="m17.362 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L11.082 16.07a4.5 4.5 0 0 1-1.897 1.13L6.5 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897zm0 0L20 7.125M18.5 14v4.75A2.25 2.25 0 0 1 16.25 21H5.75a2.25 2.25 0 0 1-2.25-2.25V8.25A2.25 2.25 0 0 1 5.75 6h4.75"
                                                        stroke="#0D2810" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg></a>

                                            <form action="{{ route($deleteLocation, [$penilaianDate, $item->id]) }}"
                                                method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="p-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                                        viewBox="0 0 25 24" fill="none">
                                                        <path
                                                            d="m15.24 9-.346 9m-4.788 0L9.76 9m9.968-3.21q.512.078 1.022.166m-1.022-.165L18.66 19.673a2.25 2.25 0 0 1-2.244 2.077H8.584a2.25 2.25 0 0 1-2.244-2.077L5.272 5.79m14.456 0a48 48 0 0 0-3.478-.397m-12 .562q.51-.088 1.022-.165m0 0a48 48 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a52 52 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a49 49 0 0 0-7.5 0"
                                                            stroke="#F66868" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="absolute flex items-center gap-14 rounded-full p-3 bg-[#201E2B]">
            <button type="button" class="inline-flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25m-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94z"
                        fill="#fff" />
                </svg>
                <span class="text-neutral-50">2 item selected</span>
            </button>
            <button type="button" class="px-4 py-2 inline-flex gap-2 bg-error-base rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21q.512.078 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48 48 0 0 0-3.478-.397m-12 .562q.51-.088 1.022-.165m0 0a48 48 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a52 52 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a49 49 0 0 0-7.5 0"
                        stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-neutral-50 font-semibold">Delete</span>
            </button>
        </div> --}}
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('itemSelected', () => ({
                selected: [],
                init() {
                    document.addEventListener('DOMContentLoaded', () => {
                        let checkboxes = document.querySelectorAll('input[type="checkbox"]');
                        this.selected = Array.from(checkboxes).map((checkbox) => (checkbox
                            .checked ? checkbox
                            .name : null)).filter((name) => name !== null);
                        if (this.selected.length > 0)
                            this.showDisplay();
                    }, false);
                },

                toggleAll() {
                    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    if (this.selected.length === checkboxes.length) {
                        this.selected = [];
                    } else {
                        this.selected = Array.from(checkboxes).map((checkbox) => checkbox.name);
                    }
                },

                elementShow() {
                    let element = ` <div id="action-selected" class="absolute bottom-3 inset-x-0 flex justify-center">
                    <div class="inline-flex items-center gap-14 rounded-full p-3 bg-[#201E2B]">
            <button type="button" class="inline-flex gap-3" onclick="clearSelected()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25m-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94z"
                        fill="#fff" />
                </svg>
                <span class="text-neutral-50">${this.selected.length} item selected</span>
            </button>
            <button type="button" onclick="deleteSelected('${this.selected}')" class="px-4 py-2 inline-flex gap-2 bg-error-base rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21q.512.078 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48 48 0 0 0-3.478-.397m-12 .562q.51-.088 1.022-.165m0 0a48 48 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a52 52 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a49 49 0 0 0-7.5 0"
                        stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-neutral-50 font-semibold">Delete</span>
            </button> </div>
        </div>`
                    return element
                },

                showDisplay() {
                    let body = document.querySelector('main')
                    if (body.querySelector('#action-selected')) {
                        body.querySelector('#action-selected').remove()
                    }
                    $(body).append(this.elementShow())
                },

                toggleCheckbox(event) {
                    if (event.target.checked) {
                        this.selected.push(event.target.name);
                    } else {
                        this.selected = this.selected.filter((name) => name !== event.target
                            .name);
                    }
                    this.showDisplay();
                },
            }));
        });

        clearSelected = () => {
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });
            document.querySelector('#action-selected').remove();
            location.reload();
        }

        deleteSelected = (selected) => {
            selected = selected.split(',');

            selected.forEach((id) => {
                let url = `{{ route('admin.data.kriteria.delete', ':id') }}`;
                id = id.replace(/\D/g, '')
                url = url.replace(':id', id);

                $.ajax(
                    url, {
                        method: 'DELETE',
                        url: url,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',

                        },
                        success: console.log('success')
                    }
                )

            });
            $.ajax({
                type: "GET",
                url: location.href,
                success: function(response) {
                    response = new DOMParser().parseFromString(response,
                        'text/html').querySelector('main').innerHTML;
                    $('main').html(response);
                }
            });
        }
    </script>
@endpush
