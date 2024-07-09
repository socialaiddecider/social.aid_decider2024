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

            <form action="{{ $updateLocation }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-header mb-5">
                    <h2 class="text-2xl">Ubah Data Penilaian</h2>
                </div>
                <div class="form-body mb-6">
                    <div class="filter">
                        <x-input-form key="created_at" title="Pilih Periode" placeholder="1/2/2024" type="date"
                            value="{{ $date }}" disabled=true />
                    </div>
                    <div class="">
                        <x-input-form key="alternatif_nama" title="Alternatif" type="text" placeholder="alternatif id"
                            value="{{ $alternatif_nama }}" disabled=true />
                        <x-input-form key="alternatif_id" title="" type="hidden" placeholder="alternatif id"
                            value="{{ $alternatif_id }}" />
                        {{-- <div class="form-group flex flex-col gap-3">
                            <label for="alternatif_id" class="text-neutral-950 font-medium">Alternatif</label>
                            <div class="" x-data="{ id: {{ $alternatif_id }} }"
                                x-effect="$(`select[name='alternatif_id']`).val(id).change()">
                                <select name="alternatif_id" id="alternatif_id"
                                    class="form-control w-full p-3 border rounded-lg" @disabled(true)>
                                    <option value="">Pilih Alternatif</option>
                                    @foreach ($alternatif as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('alternatif_id')
                                    <div class="text-sm text-error-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                    </div>
                    <div class="field-text flex flex-col gap-4 mb-5">
                        @foreach ($penilaian as $item)
                            <div class="form-group flex flex-col gap-3">
                                <label for="criteria_{{ $item->kriteria->id }}"
                                    class="text-neutral-950 font-medium">{{ $item->kriteria->nama }}</label>
                                <div class="" x-data="{ id: {{ $item->nilai }} }"
                                    x-effect="$(`select#criteria_{{ $item->kriteria->id }}`).val(id).change()">
                                    <select name="value[{{ $item->kriteria->id }}]" id="criteria_{{ $item->kriteria->id }}"
                                        class="form-control w-full p-3 border rounded-lg">
                                        <option value="" default>Pilih {{ $item->kriteria->nama }}</option>
                                        @foreach ($item->kriteria->subkriteria as $sub)
                                            <option value="{{ $sub->nilai }}">{{ $sub->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('value[{{ $item->id }}]')
                                        <div class="text-sm text-error-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-action flex justify-end">
                    <button type="submit"
                        class="btn bg-primary-base text-white transition-all duration-200 px-6 py-3 font-semibold rounded-lg">Submit</button>
                </div>
            </form>
    </section>
@endsection
