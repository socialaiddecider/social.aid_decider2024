@extends('layouts.app')
@php
    $statusStyle = [
        'pending' => ['bg' => 'bg-neutral-100', 'text' => 'text-neutral-700'],
        'approved' => ['bg' => 'bg-primary-100', 'text' => 'text-primary-700'],
        'rejected' => ['bg' => 'bg-error-100', 'text' => 'text-error-700'],
    ];
@endphp
@section('contents')
    <main class="pengajuan overflow-scroll h-screen no-scrollbar">
        @include('includes.navbar')
        <section class="mx-6 sm:mx-10 md:mx-20 -mt-8">
            <div class="header flex justify-between">
                <h1 class="text-3xl font-bold">Pengajuan Penilaian</h1>
                <div class="action">
                    <div class="add-pengajuan">
                        <a href="{{ $submissionLocation }}" class="inline-flex gap-2 items-center flex-row-reverse">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-primary-base w-10" viewBox="0 0 24 24"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25M12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25z"
                                        fill="inherit" />
                                </svg>
                            </div>
                            <h1 class="text-lg font-semibold text-primary-base">Ajukan Penilaian</h1>
                        </a>
                    </div>
                </div>
            </div>
            <div class="wrap-pengajuan w-full py-5 mt-3 grid grid-cols-1 gap-4">
                @foreach ($pengajuan as $item)
                    <div class="card min-w-fit w-full grid grid-flow-col bg-neutral-50 px-6 py-2 rounded-xl items-center">
                        <div class="card-header">
                            <h1 class="text-lg font-medium tracking-wide text-nowrap">Pengajuan pada tanggal <span
                                    class="text-primary-700">{{ $item->created_at->format('M, d-Y') }}</span>
                            </h1>
                            <p class="text-sm text-nowrap text-neutral-500">Diajukan oleh <span
                                    class="text-primary-500">{{ $item->user->name }}</span>
                            </p>
                        </div>
                        <div class="card-body justify-self-center">
                            <div class="status px-4 py-1 rounded-full {{ $statusStyle[$item->status]['bg'] }}">
                                <h1 class="text-sm font-medium {{ $statusStyle[$item->status]['text'] }}">
                                    {{ $item->status }}</h1>
                            </div>
                        </div>
                        <div class="card-action justify-self-end flex items-center">
                            <div class="dropdown relative mt-1" x-data="{ isDrop: false }" @click.away="isDrop= false">
                                <button type="button" @click="isDrop = !isDrop">
                                    <div class="icon bg-neutral-50">
                                        <svg x-show="!isDrop" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-6 transition-all">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0m0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0m0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0m0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0" />
                                        </svg>

                                        <svg x-show="isDrop" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-6 transition-all">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25m0 8.625a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25M15.375 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0M7.5 10.875a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                                <div x-show="isDrop" x-clock
                                    class="dropdown z-10 absolute text-nowrap right-2 top-8 bg-neutral-50 px-3 py-2 rounded-lg shadow-md">
                                    <a href="{{ route($showLocation, $item->id) }}"
                                        class="inline-flex gap-2 items-center p-2 pe-4 hover:bg-neutral-100 transition-all duration-150 rounded-full"
                                        x-data="{ onElement: false }" @mouseenter="onElement= !onElement"
                                        @mouseleave="onElement=false">
                                        <div :class="onElement ? 'bg-primary-500 fill-neutral-50' : 'stroke-primary-base'"
                                            class="icon rounded-full p-1 transition-transform">
                                            <template x-if="onElement">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-5 fill-inherit">
                                                    <path
                                                        d="M11.625 16.5a1.875 1.875 0 1 0 0-3.75 1.875 1.875 0 0 0 0 3.75" />
                                                    <path fill-rule="evenodd"
                                                        d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875m6 16.5c.66 0 1.277-.19 1.797-.518l1.048 1.048a.75.75 0 0 0 1.06-1.06l-1.047-1.048A3.375 3.375 0 1 0 11.625 18"
                                                        clip-rule="evenodd" />
                                                    <path
                                                        d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.77 9.77 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375z" />
                                                </svg>
                                            </template>
                                            <template x-if="!onElement">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-5 stroke-inherit">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9m3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0" />
                                                </svg>
                                            </template>
                                        </div>
                                        <span>Detail Pengajuan</span>
                                    </a>
                                    <form id="deleteAction" action="{{ route($deleteLocation, $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex gap-2 items-center p-2 pe-4 hover:bg-neutral-100 transition-all duration-150 rounded-full"
                                            x-data="{ onElement: false }" @mouseenter="onElement= !onElement"
                                            @mouseleave="onElement=false">
                                            <div :class="onElement ? 'bg-error-500 fill-neutral-50' : 'stroke-error-600'"
                                                class="icon rounded-full p-1 transition-transform">
                                                <template x-if="!onElement">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5 stroke-inherit">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9" />
                                                    </svg>
                                                </template>
                                                <template x-if="onElement">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="size-5 fill-inherit">
                                                        <path fill-rule="evenodd"
                                                            d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875M9.75 14.25a.75.75 0 0 0 0 1.5H15a.75.75 0 0 0 0-1.5z"
                                                            clip-rule="evenodd" />
                                                        <path
                                                            d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.77 9.77 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375z" />
                                                    </svg>
                                                </template>
                                            </div>
                                            <span class="text-sm">
                                                Batalkan Pengajuan
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
