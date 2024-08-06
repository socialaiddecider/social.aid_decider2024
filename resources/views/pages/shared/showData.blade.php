@extends('layouts.app')


@section('contents')
    <main class="pengajuan overflow-scroll h-screen no-scrollbar">
        @include('includes.navbar')
        <section class="mx-6 sm:mx-10 md:mx-20 -mt-8">
            <div class="header flex justify-between items-center mb-4">
                <h1 class="text-xl md:text-3xl font-bold">{{ $title }}</h1>
                <div class="action">
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
                                <input type="tel" inputmode="numeric" x-model="inputYear" size='3'
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
            <div class="content p-4 bg-neutral-50 rounded-2xl relative">
                <div class="table w-full">
                    <div class="header-table flex justify-between items-center mb-6">


                    </div>
                    <div class="table-wrap">
                        <div class="relative">
                            <table class="w-full table-auto">
                                <thead class="border-b-2 bg-neutral-50">
                                    <tr class="">
                                        <th class="px-6 py-4 text-start text-sm font-semibold">No</th>
                                        <th class="px-6 py-4 text-start text-sm font-semibold">Nama</th>
                                        <th class="px-6 py-4 text-start text-sm font-semibold">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @php
                                        $styleJenis = [
                                            'tidak menerima' => 'bg-rose-200 text-rose-500',
                                            'menerima' => 'bg-primary-200 text-primary-500',
                                        ];
                                    @endphp
                                    @foreach ($penerima as $key => $item)
                                        <tr class="">

                                            <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-sm">{{ $item->nama }}</td>
                                            <td class="px-6 py-4 text-sm ">
                                                <span
                                                    class="px-4 py-1 rounded-full capitalize font-semibold {{ $item->status == 'Menerima' ? $styleJenis['menerima'] : $styleJenis['tidak menerima'] }}">{{ $item->status }}</span>

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
    </main>
@endsection
