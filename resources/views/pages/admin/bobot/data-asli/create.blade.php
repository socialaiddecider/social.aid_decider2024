@extends('layouts.admin.sidebar')

@section('contents-admin')
    <section class="kriteria py-6 px-8 overflow-y-auto no-scrollbar ">
        <div class="header mb-6">
            <div class="wrap flex justify-between">
                <div class="title text-2xl font-semibold">
                    <h1 class="">{{ $title }}</h1>
                </div>
            </div>
        </div>
        <div class="content-body p-6 bg-neutral-50 rounded-2xl relative">

            <form action="{{ $storeLocation }}" method="POST">
                @csrf
                <div class="form-header mb-5">
                    <h2 class="text-2xl">Tambahkan Data Asli</h2>
                </div>
                <div class="form-body mb-6">
                    <div class="field-text flex flex-col gap-4 mb-5">
                        <x-input-form key="created_at" placeholder="Masukkan kode alternatif" type="date"
                            title="Tanggal" />
                    </div>

                    <div class="select-field">
                        <div class="form-group flex flex-col gap-3">
                            <label for="alternatif_id" class="text-neutral-950 font-medium">Alternatif</label>
                            <div class="">
                                <select name="alternatif_id" id="alternatif_id"
                                    class="form-control w-full p-3 border rounded-lg">
                                    <option value="" default>Pilih Alternatif</option>
                                    @foreach ($alternatif as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('alternatif_id')
                                    <div class="text-sm text-error-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group flex flex-col gap-3">
                            <label for="status" class="text-neutral-950 font-medium">Alternatif</label>
                            <div class="">
                                <select name="status" id="status" class="form-control w-full p-3 border rounded-lg">
                                    <option value="" default>Pilih Status</option>
                                    @foreach ($status as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="text-sm text-error-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-action flex justify-end">
                    <button type="submit"
                        class="btn bg-primary-base text-white transition-all duration-200 px-6 py-3 font-semibold rounded-lg">Submit</button>
                </div>
            </form>
    </section>
@endsection
