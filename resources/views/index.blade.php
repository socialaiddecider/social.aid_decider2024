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
    <style>
        @foreach ($countData as $key => $value)
                {
                @property --num-{{ $key }} {
                    syntax: "<integer>";
                    initial-value: 0;
                    inherits: false;
                }
            }
        @endforeach

        @keyframes counter {

            /* @for ($i = 0; $i <= 100; $i += 10)
            {{ $i }}% {
                @foreach ($countData as $key => $value)
                    @if ($i == 0)
                        --num-{{ $key }}: {{ $i }};
                    @elseif($i == 100)
                        --num-{{ $key }}: {{ $value }};
                    @else
                        --num-{{ $key }}: {{ $i }};
                    @endif
                @endforeach
            }
        @endfor
        */
        }
    </style>
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
                        <li><a href="{{ route('index') }}">
                                <h1 class="px-8 py-6 bg-primary-base rounded-2xl text-neutral-50 leading-5">Masukkan Data
                                </h1>
                            </a></li>
                        <li><a href="{{ route('index') }}">
                                <h1 class="px-8 py-6 rounded-2xl border border-primary-300 text-primary-base leading-5">
                                    Penerima
                                    yang ideal</h1>
                            </a></li>
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
            <ul class="flex text-neutral-50 justify-around">
                <li class="w-60">
                    <h1 class="text-[64px] mb-1 font-bold "><span
                            class="animate-[counter_1s_ease-out_forwards] tabular-nums [counter-set:_num_var(--num-users)] before:content-[counter(num)]"><span
                                class="sr-only">15</span>k+</span></h1>
                    <p class="font-normal leading-6">15 ribu lebih orang telah terbantu dengan baik melalui sistem ini</p>
                </li>
                <li class="w-60">
                    <h1 class="text-[64px] mb-1 font-bold"><span
                            class="animate-[counter_1s_ease-out_forwards] tabular-nums [counter-set:_num_var(--num-villages)] before:content-[counter(num)]"><span
                                class="sr-only">50</span></span></h1>
                    <p class="font-normal leading-6">50 desa sudah menggunakan sistem ini untuk membantu menentukan penerima
                    </p>
                </li>
                <li class="w-60">
                    <h1 class="text-[64px] mb-1 font-bold"><span
                            class="animate-[counter_1s_ease-out_forwards] tabular-nums [counter-set:_num_var(--num-certification)] before:content-[counter(num)]"><span
                                class="sr-only">5</span></span></h1>
                    <p class="font-normal leading-6">5 Sertifikasi langsung dari pemerintah dan lisensi penggunaan sistem
                    </p>
                </li>
            </ul>
        </section>
        <section class="h-screen">

        </section>
    </main>
@endsection
