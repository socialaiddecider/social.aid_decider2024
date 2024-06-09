@extends('layouts.app')


@php
    $heroImage = Vite::asset('resources/assets/images/beranda/heroImage.jpg');
    $aboutImage = Vite::asset('resources/assets/images/beranda/aboutImage.jpeg');
    $brandLogo = Vite::asset('resources/assets/brand/brandLogo.svg');
    $teamImage = [
        'Muhammad Al Kindy' => [
            'path' => Vite::asset('resources/assets/images/team/Muhammad_Al_Kindy.jpeg'),
            'nim' => '2141762057',
            'position' => 'Web Developer',
        ],
        'Vivi Nur Wijayaningrum, S.Kom, M.Kom' => [
            'path' => Vite::asset('resources/assets/images/team/Vivi_Nur_Wijayaningrum,_S.Kom,_M.Kom.jpeg'),
            'nim' => '',
            'position' => 'Dosen Pembimbing',
        ],
        'Ifa Indrian Ningsih' => [
            'path' => Vite::asset('resources/assets/images/team/Ifa_Indrian_Ningsih.jpeg'),
            'nim' => '2041720007',
            'position' => 'Project Manager',
        ],
        'Thoriq Fathurrozi' => [
            'path' => Vite::asset('resources/assets/images/team/Thoriq_Fathurrozi.jpeg'),
            'nim' => '2241720052',
            'position' => 'Web Developer',
        ],
        'Moch. Naufal Ardian Ramadhan' => [
            'path' => Vite::asset('resources/assets/images/team/Moch._Naufal_Ardian_Ramadhan.jpeg'),
            'nim' => '2341760148',
            'position' => 'UI/UX Designer',
        ],
        'Niken Maharani Permata' => [
            'path' => Vite::asset('resources/assets/images/team/Niken_Maharani_Permata.jpeg'),
            'nim' => '2141762006',
            'position' => 'Data Analyst',
        ],
    ];

    $countData = [
        'users' => 15,
        'villages' => 50,
        'certification' => 5,
    ];
@endphp

@push('styles')
@endpush

@section('contents')
    <main class="overflow-scroll h-screen no-scrollbar">

        @include('includes.navbar')
        <section class="mx-20 flex justify-between xl:justify-around mt-3 mb-11">
            <div class="hero-desc flex justify-start animate-fadeIn transition-all">
                <div class="w-[453px]">
                    <div class="text mb-8">
                        <h1
                            class="inline-block text-[64px] font-bold leading-snug mb-4 bg-gradient-to-r from-[#194F1F] -from-[0.85%] via-[#649069] via-[38%] to-[#4D7151] to-[97%] text-transparent bg-clip-text">
                            Meningkatkan
                            Kesejahteraan
                            Masyarakat</h1>
                        <p class="text-neutral-base font-normal leading-6">Website kami digunakan untuk menginput data calon
                            penerima bantuan sosial yang akan diuji kelayakannya untuk menerima bantuan sosial sehingga
                            bantuan
                            sosial yang diberikan tepat sasaran.</p>
                    </div>
                    <ul class="action flex gap-8">
                        <li>
                            <a href="{{ route('index') }}">
                                <button onclick="window.utils.Animate.rippleEffect(event)" class="overflow-hidden relative">
                                    <h1 class="px-8 py-6 bg-primary-base rounded-2xl text-neutral-50 leading-5">
                                        {{ Auth::user() ? 'Masukkan Data' : 'Lihat Data' }}
                                    </h1>
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index') }}">
                                <button onclick="window.utils.Animate.rippleEffect(event)" class="overflow-hidden relative">
                                    <h1 class="px-8 py-6 rounded-2xl border border-primary-300 text-primary-base leading-5">
                                        {{ Auth::user() ? 'Penerima yang ideal' : 'Bergabung sekarang' }}
                                    </h1>
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hero-image flex justify-end">
                <div class="relative animate-fadeIn">
                    <div class="w-[568px] h-[568px] rounded-xl rotate-6 bg-primary-base transition-all animate-shiftRight">
                    </div>
                    <div class="absolute top-0 w-[568px] h-[568px] animate-shiftLeft transition-all rounded-xl bg-primary-base !bg-cover !bg-center"
                        style="background: url({{ $heroImage }});"></div>
                </div>
            </div>
        </section>
        <section class="hero-label bg-gradient-to-r from-primary-500 to-[#1A5020] to-[55%] px-20 py-10">
            <ul class="flex text-neutral-50 justify-around" x-data="{}">
                <li class="w-60">
                    <h1 class="text-[64px] mb-1 font-bold "><span class="Count">15</span>k+</h1>
                    <p class="font-normal leading-6">15 ribu lebih orang telah terbantu dengan baik melalui sistem ini</p>
                </li>
                <li class="w-60">
                    <h1 class="text-[64px] mb-1 font-bold"><span class="Count">50</span></h1>
                    <p class="font-normal leading-6">50 desa sudah menggunakan sistem ini untuk membantu menentukan penerima
                    </p>
                </li>
                <li class="w-60">
                    <h1 class="text-[64px] mb-1 font-bold"><span class="Count">5</span></h1>
                    <p class="font-normal leading-6">5 Sertifikasi langsung dari pemerintah dan lisensi penggunaan sistem
                    </p>
                </li>
            </ul>
        </section>
        <section class="h-screen">

        </section>
        <section id="our-team" class="px-11 mb-16">
            <div class="grid grid-rows-3 grid-cols-1 justify-center gap-8">
                <div class="py-16 px-20 text-neutral-100 text-center bg-primary-base rounded-xl ">
                    <div class="text">
                        <h3 class="text-[32px] font-medium">Tentang Kami 🔫</h3>
                        <h1 class="text-[80px] text-neutral-50 font-medium"><span class="font-bold">Kenali Lebih
                                Dekat</span> <br> Tentang Kami
                        </h1>
                        <h6 class="text-[32px]">Tak kenal maka tak terkenal maka dari itu mari kenalan</h6>
                    </div>
                </div>
                <div class="row-span-2">
                    <div class="grid grid-cols-2 w-full gap-4">
                        <div class="w-full h-full rounded-xl overflow-hidden" style="background:url({{ $aboutImage }});">
                            <img src="{{ $aboutImage }}" alt="">
                        </div>
                        <div class="grid grid-rows-2 grid-cols-1 gap-4">
                            <div
                                class="bg-primary-base text-center rounded-xl relative flex items-center justify-center text-neutral-50 overflow-hidden">
                                <h1 class="font-extrabold text-[64px]">WE ARE HERE <br> FOR YOU</h1>
                                <svg width="270" height="270" viewBox="0 0 270 270" fill="none"
                                    class="absolute -top-24 -left-[105px]" xmlns="http://www.w3.org/2000/svg">
                                    <circle opacity=".5" cx="135" cy="135" r="120.5" stroke="#D1DCD2"
                                        stroke-width="29" />
                                </svg>
                                <svg width="270" height="270" viewBox="0 0 270 270" fill="none"
                                    class="absolute -top-5 -left-[120px]" xmlns="http://www.w3.org/2000/svg">
                                    <circle opacity=".5" cx="135" cy="135" r="120.5" stroke="#D1DCD2"
                                        stroke-width="29" />
                                </svg>
                                <svg width="270" height="270" viewBox="0 0 270 270" fill="none"
                                    class="absolute -bottom-10 -right-[100px]" xmlns="http://www.w3.org/2000/svg">
                                    <circle opacity=".5" cx="135" cy="135" r="120.5" stroke="#D1DCD2"
                                        stroke-width="29" />
                                </svg>
                                <svg width="270" height="270" viewBox="0 0 270 270" fill="none"
                                    class="absolute -bottom-24 -right-[80px]" xmlns="http://www.w3.org/2000/svg">
                                    <circle opacity=".5" cx="135" cy="135" r="120.5" stroke="#D1DCD2"
                                        stroke-width="29" />
                                </svg>
                            </div>
                            <div class=" rounded-xl overflow-hidden flex justify-center items-center bg-neutral-50">
                                <div class="brand fill-primary-base  ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="506" height="199"
                                        viewBox="0 0 84 34" fill="inherit">
                                        <g clip-path="url(#a)" fill="inherit">
                                            <path
                                                d="M19.939.5a12.24 12.24 0 0 0-8.746 3.7l-7.57 7.733A12.77 12.77 0 0 0 0 20.866C0 27.844 5.538 33.5 12.369 33.5a12.24 12.24 0 0 0 8.746-3.7l5.236-5.349L41.608 8.867A5.85 5.85 0 0 1 45.785 7.1c2.623 0 4.847 1.746 5.618 4.163l4.815-4.919C54.02 2.83 50.169.5 45.785.5a12.24 12.24 0 0 0-8.746 3.7L16.546 25.133a5.85 5.85 0 0 1-4.177 1.767c-3.263 0-5.907-2.701-5.907-6.034a6.1 6.1 0 0 1 1.73-4.266l7.57-7.733A5.85 5.85 0 0 1 19.939 7.1c2.623 0 4.847 1.746 5.618 4.163l4.815-4.919C28.175 2.83 24.323.5 19.939.5" />
                                            <path
                                                d="M42.392 25.133a5.85 5.85 0 0 1-4.177 1.767c-2.623 0-4.846-1.746-5.617-4.162l-4.815 4.919C29.979 31.17 33.83 33.5 38.215 33.5a12.24 12.24 0 0 0 8.746-3.7L67.454 8.867A5.85 5.85 0 0 1 71.631 7.1c3.263 0 5.907 2.701 5.907 6.034a6.1 6.1 0 0 1-1.73 4.266l-7.57 7.733a5.85 5.85 0 0 1-4.177 1.767c-2.623 0-4.846-1.746-5.617-4.162l-4.815 4.918C55.825 31.17 59.677 33.5 64.06 33.5a12.24 12.24 0 0 0 8.746-3.7l7.57-7.733A12.77 12.77 0 0 0 84 13.134C84 6.156 78.462.5 71.631.5a12.24 12.24 0 0 0-8.746 3.7z" />
                                        </g>
                                        <defs>
                                            <clipPath id="a">
                                                <path fill="#fff" d="M0 .5h84v33H0z" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="our-team-people" class="px-11 mb-16">
            <div class="header mb-8">
                <h6 class="text-primary-500 text-xl font-medium">Our Team</h6>
                <h1 class="text-neutral-base text-[40px] font-semibold">Our Excellence Team</h1>
            </div>
            <div class="grid grid-cols-3 grid-rows-2 gap-4">
                @foreach ($teamImage as $memberName => $data)
                    <div class="team-card rounded-xl overflow-hidden">
                        <div class="image-team w-full h-[564px] bg-cover bg-center"
                            @if ($data['nim'] == '') style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 15.45%, rgba(0, 0, 0, 0.60) 77.73%), url({{ $data['path'] }}) lightgray 0px -2.842px / 100% 117.586% no-repeat;" @elseif($data['nim'] == '2241720052') style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 15.45%, rgba(0, 0, 0, 0.60) 77.73%), url({{ $data['path'] }}) lightgray -54px -122.153px / 124.434% 130.024% no-repeat;" @else 
                            style="background:linear-gradient(180deg, rgba(0, 0, 0, 0.00) 15.45%, rgba(0, 0, 0, 0.60) 77.73%), url('{{ $data['path'] }}') lightgray 50% / cover no-repeat;" @endif>

                            <div class="px-4 pb-9 w-full h-full flex flex-col justify-end text-neutral-50">
                                <h1 class="font-semibold text-2xl mb-1">{{ $memberName }}</h1>
                                <h5 class="text-sm text-neutral-100 mb-2">{{ $data['nim'] }}</h5>
                                <h2 class="font-medium">{{ $data['position'] }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
        @include('includes.footer')
    </main>
@endsection
