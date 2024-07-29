@extends('layouts.app')
@php
    $statusStyle = [
        'pending' => ['bg' => 'bg-neutral-300', 'text' => 'text-neutral-700'],
        'approved' => ['bg' => 'bg-primary-300', 'text' => 'text-primary-700'],
        'rejected' => ['bg' => 'bg-error-300', 'text' => 'text-error-700'],
    ];
@endphp
@section('contents')
    <main class="pengajuan overflow-scroll h-screen no-scrollbar">
        @include('includes.navbar')
        <section class="mx-6 sm:mx-10 md:mx-20 -mt-8">
            <div class="header justify-between">
                <h1 class="text-2xl md:text-3xl font-bold">Detail Pengajuan Penilaian</h1>
                <div class="inline-flex flex-col gap-1 mt-2">
                    <h3>Diajukan oleh {{ $pengajuan->name }} pada tanggal {{ $pengajuan->created_at->format('M, d Y') }}
                    </h3>
                    <h6 class="px-4 py-1 w-fit rounded-full font-semibold {{ $statusStyle[$pengajuan->status]['bg'] }}">
                        <span class="{{ $statusStyle[$pengajuan->status]['text'] }}">{{ $pengajuan->status }}</span>
                    </h6>
                </div>
            </div>
            <div class="wrap-detail-pengajuan w-full py-5 mt-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($detailPengajuan as $item)
                    <div class="card bg-neutral-50 px-6 py-4 rounded-lg">
                        <h1 class="text-xl font-medium">Kriteria <span
                                class="text-primary-600">#{{ $loop->iteration }}</span>
                        </h1>
                        <div class="card-body">
                            <div class="">
                                <h3 class="text-nowrap">{{ $item->kriteria_nama }}</h3>
                                <div class="flex justify-between gap-2 items-end">
                                    <h3 class="">Anda memilih : {{ $item->subkriteria_nama }}</h3>
                                    <div class="">
                                        <div
                                            class="bg-primary-600  px-2 py-1 w-10 rounded-full inline-flex justify-center items-center">
                                            <h4 class="font-bold text-neutral-100">{{ $item->nilai }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
