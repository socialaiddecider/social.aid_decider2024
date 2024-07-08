@extends('layouts.app')

@php
    $brandLogo = Vite::asset('resources/assets/brand/brandLogo.svg');

    $sidebar = [
        'General' => [
            'Dashboard' => [
                'icon' => 'm21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9',
                'link' => ['admin.dashboard'],
            ],
            'Berita' => [
                'icon' =>
                    'M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98z',
                'link' => ['admin.news'],
            ],
        ],
        'Master Data' => [
            'Data Kriteria' => [
                'icon' =>
                    'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9',
                'link' => ['admin.data.kriteria.index', 'admin.data.kriteria.create', 'admin.data.kriteria.edit'],
            ],
            'Data Subkriteria' => [
                'icon' =>
                    'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9',
                'link' => [
                    'admin.data.subkriteria.index',
                    'admin.data.subkriteria.detail',
                    'admin.data.subkriteria.create',
                    'admin.data.subkriteria.edit',
                ],
            ],
            'Data Alternatif' => [
                'icon' =>
                    'M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9 9 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9 9 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75',
                'link' => ['admin.data.alternatif.index', 'admin.data.alternatif.create', 'admin.data.alternatif.edit'],
            ],
        ],
        'Manajemen' => [
            'Data Penilaian' => [
                'icon' =>
                    'M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98z',
                'link' => [
                    'admin.management.penilaian.index',
                    'admin.management.penilaian.create',
                    'admin.management.penilaian.edit',
                ],
            ],
            'Hasil Perhitungan' => [
                'icon' =>
                    'M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9 9 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9 9 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75',
                'link' => ['admin.management.perhitungan'],
            ],
            'Hasil Penerima' => [
                'icon' =>
                    'M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"',
                'link' => ['admin.management.penerima'],
            ],
        ],
        'Pencarian Bobot' => [
            'Data Asli' => [
                'icon' =>
                    'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9',
                'link' => ['admin.bobot.data-asli.index', 'admin.bobot.data-asli.create', 'admin.bobot.data-asli.edit'],
            ],
            'Cari Bobot Kriteria' => [
                'icon' =>
                    'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9m3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0',
                'link' => ['admin.bobot.kriteria.index', 'admin.bobot.kriteria.calc'],
            ],
        ],
    ];

@endphp

@section('contents')
    <div class="flex">
        <aside
            class="sidebar px-6 py-6 bg-neutral-50 h-screen flex flex-col transition-all duration-500 ease-in-out border-e-2 border-neutral-200"
            :class="!detailSidebarOpen ? 'w-fit' : 'w-72'" x-data="{ detailSidebarOpen: true }">
            <div class="sidebar-header mb-12 flex justify-between">
                <div class="brand flex items-center" :class="!detailSidebarOpen ? 'hidden' : ''">
                    <a href="{{ route('index') }}" class="flex items-center">
                        <div class="brand pe-4 fill-primary-base">
                            {!! file_get_contents($brandLogo) !!}
                        </div>
                    </a>
                </div>
                <div class="sidebar-action">
                    <button type="button" @click="detailSidebarOpen = !detailSidebarOpen"
                        class="stroke-primary-base opacity-80 p-2 transition-all duration-500"
                        :class="!detailSidebarOpen ? 'rotate-180' : 'pe-0'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="inherit" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="grow overflow-y-auto no-scrollbar">
                <div class="sidebar-content h-full">
                    <div class="">
                        @foreach ($sidebar as $key => $value)
                            <div class="sidebar-group border-b mb-3">
                                <div class="sidebar-group-header">
                                    <h1 class="text-neutral-300 text-base font-medium"
                                        :class="!detailSidebarOpen ? 'hidden' : ''">
                                        {{ $key }}</h1>
                                </div>
                                <ul class="sidebar-group-content pt-3 pb-4">
                                    @foreach ($value as $key => $value)
                                        <li class="sidebar-link hover:bg-neutral-100 mb-1 {{ request()->routeIs($value['link']) ? 'bg-neutral-100' : '' }}"
                                            :class="!detailSidebarOpen ? 'rounded-full' : 'rounded-lg'">
                                            <a href="{{ route($value['link'][0]) }}" class="flex gap-3"
                                                :class="!detailSidebarOpen ? 'p-2 justify-center' : 'py-3 ps-3'">
                                                <div class="icon-sidebar-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="{{ $value['icon'] }}" />
                                                    </svg>
                                                </div>
                                                <h1 class="text-neutral-950 text-base font-medium"
                                                    :class="!detailSidebarOpen ? 'hidden' : ''">{{ $key }}
                                                </h1>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="sidebar-footer pt-5">
                <h1 class="text-neutral-400 text-xs font-normal text-center"
                    x-text="!detailSidebarOpen ? '@ 2024' : '@ 2024 social.aid_decider'"></h1>
            </div>
        </aside>
        <main class="grow h-screen flex flex-col relative">
            <div class="breadcrumb py-4 px-7 bg-neutral-50 w-full flex justify-between border-b-2 border-neutral-200">
                <div class="left">
                    <div class="search border flex p-3 rounded-xl gap-4">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.275 1.714a8.561 8.561 0 1 1 0 17.122 8.561 8.561 0 0 1 0-17.122m8.624 15.774a1.411 1.411 0 1 1-.001 2.822 1.411 1.411 0 0 1 0-2.822"
                                clip-rule="evenodd" stroke="#2B2B2B" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <input type="text" class="focus:outline-none" placeholder="Search">
                    </div>
                </div>
                <div class="right flex divide-x items-center">
                    <div class="wrap-action flex gap-4 items-center pe-6">

                    </div>
                    <div class="profile flex ps-6 items-center">
                        <div class="profile-image w-8 h-8 rounded-full me-2"
                            style="background: url({{ Vite::asset('resources/assets/images/team/Thoriq_Fathurrozi.jpeg') }});background-size:cover; background-position:center;">
                        </div>
                        <div class="profile-name">
                            <h1 class="text-sm text-neutral-base">Thoriq</h1>
                            <p class="text-xs text-neutral-300">Admin</p>
                        </div>
                        <div class="action relative" x-data="{ isDropdownOpen: false }">
                            <button type="button" class="ms-4 w-6 h-6" @click="isDropdownOpen = !isDropdownOpen">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25"
                                    class="transform transition-transform duration-500 ease-in-out"
                                    :class="isDropdownOpen ? 'rotate-180' : ''" fill="none">
                                    <path d="m19.5 8.75-7.5 7.5-7.5-7.5" stroke="#1B1B1B" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div class="dropdown ring-1 ring-neutral-300 absolute w-fit bg-neutral-50 rounded-xl px-3 py-2 right-0 top-10"
                                x-show="isDropdownOpen" @click.away="isDropdownOpen =false">
                                <a href="{{ route('auth.signOut') }}"
                                    class="text-nowrap rounded-lg hover:bg-neutral-200 transition-all px-2 py-1">Sign
                                    Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('contents-admin')
        </main>
    </div>
@endsection