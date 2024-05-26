@extends('layouts.app')

@php
    $cardImage = Vite::asset('resources/assets/images/beranda/signInImageCard.jpg');
    $backgroundImage = Vite::asset('resources/assets/images/beranda/signInImageBg.jpg');
@endphp

@section('contents')
    <main class="pb-12 overflow-auto h-screen">
        @include('includes.navbar')
        <section class="relative">
            <div class="mx-[73px] grid grid-cols-2 gap-6">
                <div class="left animate-fadeIn">
                    <div class="header py-16">
                        <div class="text-header text-center mb-8">
                            <h2 class="text-[32px] text-primary-base">Social Aid Decider</h2>
                            <p class="text-5xl leading-normal font-medium tracking-wider antialiased relative">Login untuk
                                menambahkan data
                                calon penerima <span
                                    class="relative before:absolute before:-inset-1 before:-z-10 before:top-2/3 before:bottom-1 before:rounded-full before:bg-gradient-to-r before:from-primary-base before:from-[1%] before:to-[#3D6842] before:mix-blend-hard-light inline-block">
                                    bantuan
                                    sosial
                                </span>
                            </p>
                        </div>
                        <div class="action-header text-center antialiased">
                            <h4 class="mb-4 text-neutral-400">Belum punya akun?</h4>
                            <a href="" class="inline-flex justify-self-center">
                                <h4
                                    class="w-fit px-4 relative after:absolute after:h-0.5 after:rounded-full after:mt-2 after:top-3/4 after:-z-10 after:inset-1 after:bg-black">
                                    Buat
                                    akun
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
                                <p class="bg-neutral-50 px-3">bersama social aid decider</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right rounded-2xl overflow-hidden animate-[fadeIn_800ms_ease-in]">
                    <div class="signIn h-full !bg-cover !bg-center flex justify-center items-center"
                        style="background: url({{ $backgroundImage }})">
                        <div class="px-9 py-16 bg-neutral-50  rounded-2xl min-w-[400px] w-4/5 ">
                            <form action="{{ route('auth.postSignIn') }}" method="post">
                                @csrf
                                <div class="header mb-7 text-center">
                                    <h1 class="font-semibold text-neutral-base">Login to your account</h1>
                                </div>
                                <div class="form-content flex flex-col gap-6">
                                    <div class="form-body flex flex-col gap-[18px]">
                                        <div class="form-input">
                                            <label for="username"
                                                class="block text-neutral-400 antialiased">Username</label>
                                            <input id="username" type="text" name="username"
                                                class="w-full transition-all border-b py-3 outline-none focus:border-primary-500 placeholder:text-gray-200"
                                                placeholder="Enter your username" autocomplete="off">
                                        </div>
                                        <div class="form-input">
                                            <label for="password"
                                                class="block text-neutral-400 antialiased">Password</label>
                                            <input id="password" type="password" name="password"
                                                class="w-full transition-all border-b py-3 outline-none focus:border-primary-500 placeholder:text-gray-200"
                                                placeholder="Enter your password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-function">
                                        <div class="flex justify-between items-center">
                                            <div id="checkbox" class="inline-flex gap-2 items-center">
                                                <label class="relative rounded-full cursor-pointer flex items-center">
                                                    <input type="checkbox"
                                                        class="peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-primary-200 transition-all before:absolute  before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-primary-500 before:opacity-0 before:transition-opacity checked:border-primary-base checked:bg-primary-base checked:before:bg-primary-base hover:before:opacity-10
                                                        "
                                                        name="remember" />
                                                    <span
                                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                            viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                            stroke-width="1">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                </label>
                                                <label
                                                    class="text-xs font-light text-primary-700 cursor-pointer select-none">
                                                    Remember Me
                                                </label>
                                            </div>
                                            <a href="">
                                                <p class="text-xs font-normal text-neutral-400 antialiased">Forgot password
                                                    your password?
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-action">
                                        <button
                                            class="w-full py-3 px-4 relative overflow-hidden bg-primary-base rounded-2xl text-neutral-50 font-semibold transition-all hover:bg-primary-500"
                                            type="submit" onclick="window.utils.Animate.rippleEffect(event)"
                                            data-action="submit">Login</button>
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
