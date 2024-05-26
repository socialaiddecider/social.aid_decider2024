@extends('layouts.app')


@php
    $heroImage = Vite::asset('resources/assets/images/beranda/heroImage.jpg');
    $countData = [
        'users' => 15,
        'villages' => 50,
        'certification' => 5,
    ];
@endphp

@push('styles')
@endpush

@section('contents')
    <main class="overflow-scroll h-screen">

        @include('includes.navbar')
        <section class="mx-20 flex justify-between xl:justify-around mt-3 mb-11">
            <div class="hero-desc flex justify-start animate-fadeIn transition-all">
                <div class="w-[453px]">
                    <div class="text mb-8">
                        <h1
                            class="inline-block text-[64px] font-bold leading-snug mb-4 bg-gradient-to-r from-[#194F1F] -from-[0.85%] via-[#649069] via-[38%] to-[#4D7151] to-[90%] text-transparent bg-clip-text">
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
                                    <h1 class="px-8 py-6 bg-primary-base rounded-2xl text-neutral-50 leading-5">Masukkan
                                        Data
                                    </h1>
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index') }}">
                                <button onclick="window.utils.Animate.rippleEffect(event)" class="overflow-hidden relative">
                                    <h1 class="px-8 py-6 rounded-2xl border border-primary-300 text-primary-base leading-5">
                                        Penerima
                                        yang ideal
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
        <section class="hero-label bg-gradient-to-r from-primary-base to-primary-500 to-[55%] px-20 py-10">
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
    </main>
@endsection
