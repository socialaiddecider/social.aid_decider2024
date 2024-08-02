@extends('layouts.app')

@section('contents')
    <main class="profile overflow-scroll h-screen no-scrollbar">
        @include('includes.navbar')
        <section class="mx-2 sm:mx-10 md:mx-20 -mt-8">
            <div class="flex justify-center mt-20">
                <div class="card-verify bg-neutral-50 rounded-xl relative w-1/2">
                    <div
                        class="icon absolute -top-8 bg-neutral-50 ring ring-primary-300 fill-primary-base left-1/2 -translate-x-1/2 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-8 fill-inherit">
                            <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0z" />
                            <path
                                d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0z" />
                        </svg>
                    </div>
                    <div class="card-body px-10 py-8">
                        <div class="card-verify-header mb-4 text-center">
                            <h1 class="text-4xl font-bold">Verify Your Email!</h1>
                        </div>
                        <div class="card-verify-body flex flex-col items-center">
                            <div class="card-text w-2/4 text-center">
                                <p class="text-sm">A verification link has been sent to your email address. Please click on
                                    the
                                    link
                                    to verify your email address. If you did not receive the email, click the
                                    button
                                    below to request another verification link</p>
                            </div>
                            <form action="{{ $verifyEmailLocation }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="btn bg-primary-500 text-neutral-50 px-6 font-semibold py-2 rounded-xl  mt-4">Resend
                                    Verification
                                    Link</button>
                            </form>

                        </div>
                    </div>

                </div>
        </section>
    </main>
@endsection
