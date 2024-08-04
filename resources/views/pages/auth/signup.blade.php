@extends('layouts.app')

@php
    $cardImage = Vite::asset($cardImagePath);
    $backgroundImage = Vite::asset($backgroundImagePath);
@endphp

@section('contents')
    <main class="pb-12 overflow-auto h-screen">
        @include('includes.navbar')
        <section class="relative">
            <div class="mx-4 md:mx-[73px] grid md:grid-cols-2 md:gap-6">
                <div class="left animate-fadeIn hidden md:block">
                    <div class="header py-16">
                        <div class="text-header text-center mb-8">
                            <h2 class="text-[32px] text-primary-base ">Social Aid Decider
                            </h2>
                            <p class="text-5xl leading-normal font-medium tracking-wider antialiased relative">
                                Login untuk
                                menambahkan data
                                calon penerima <span
                                    class="relative before:absolute before:-inset-0 before:-z-10 before:top-2/3 before:bottom-1 before:rounded-full mix-blend-hard-light before:bg-gradient-to-r before:from-primary-base before:from-[1%] before:to-[#3D6842]  inline-block before:animate-[fill_2s_ease-in-out] before:transition-all">
                                    bantuan
                                    sosial
                                </span>
                            </p>
                        </div>
                        <div class="action-header text-center antialiased">
                            <h4 class="mb-4 text-neutral-400">Saya sudah punya akun</h4>
                            <a href="{{ route('auth.signIn') }}" class="inline-flex justify-self-center">
                                <h4
                                    class="w-fit px-4 relative after:absolute after:h-0.5 after:rounded-full after:mt-2 after:top-3/4 after:-z-10 after:inset-1 after:bg-black">
                                    Login
                                </h4>
                            </a>
                        </div>
                    </div>
                    <div class="card bg-red-100 rounded-2xl overflow-hidden ">
                        <div class="card-body !bg-cover !bg-center h-[300px] w-full"
                            style="background: url({{ $cardImage }})">
                            <div
                                class="w-full h-full text  flex items-center justify-center flex-col backdrop-brightness-50">
                                <h1 class="text-5xl font-semibold text-neutral-50 leading-relaxed">#PeduliRakyat</h1>
                                <p class="bg-neutral-50 px-3 text-primary-base">bersama social aid decider</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right rounded-2xl h-screen md:h-full overflow-hidden animate-[fadeIn_800ms_ease-in]">
                    <div class="signIn h-full !bg-cover !bg-center flex justify-center items-center"
                        style="background: url({{ $backgroundImage }})">
                        <div class="p-9 bg-neutral-50  rounded-2xl md:min-w-[400px] md:w-4/5 w-11/12 ">
                            <form action="{{ $actionLocation }}" method="post">
                                @csrf
                                <div class="header mb-4 text-center">
                                    <h1 class="font-semibold text-neutral-base">Register account</h1>
                                </div>
                                <div class="form-content flex flex-col gap-3">
                                    <div class="form-body flex flex-col gap-2">
                                        <x-input-form key="name" title="Nama" placeholder="Nama Lengkap"
                                            type="text" />
                                        <x-input-form key="username" title="Username" placeholder="Masukkan username anda"
                                            type="text" />
                                        <x-input-form key="nkk" title="NKK" placeholder="Masukkan NKK anda"
                                            type="text" />
                                        <x-input-form key="email" title="Email" placeholder="Masukkan email anda"
                                            type="email" />
                                        <x-input-form key="password" title="Password" placeholder="Password baru"
                                            type="password" />
                                        <x-input-form key="confirm_password" title="Konfirmasi Password"
                                            placeholder="Konfirmasi Password anda" type="password" />
                                    </div>

                                    <div class="form-action">
                                        <button
                                            class="w-full py-3 px-4 relative overflow-hidden bg-primary-base rounded-2xl text-neutral-50 font-semibold transition-all hover:bg-primary-500"
                                            type="submit" onclick="window.utils.Animate.ripple.rippleEffect(event)"
                                            data-action="submit">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
@endpush
