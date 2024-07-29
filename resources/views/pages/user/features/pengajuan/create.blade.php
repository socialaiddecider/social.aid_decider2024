@extends('layouts.app')

@section('contents')
    <main class="pengajuan overflow-scroll h-screen no-scrollbar">
        @include('includes.navbar')
        <section class="mx-6 sm:mx-10 md:mx-20 -mt-8">
            <div class="mark-proggress">

            </div>
            <form action="{{ $updateLocation }}" method="POST" class="pt-6 pb-10">
                @csrf
                <div class="form-header mb-2">
                    <h2 class="text-4xl font-bold">Ajukan Data Penilaian</h2>
                    <p class="text-sm mt-1">Lakukan pengisian data sesuai dengan kondisi anda saat ini</p>
                </div>
                <div class="form-body mb-2">
                    <div class="field-text flex flex-col gap-3 mb-5">
                        @foreach ($kriteria as $item)
                            <div class="form-group flex flex-col gap-3">
                                <label for="criteria_{{ $item->id }}"
                                    class="text-neutral-950 font-medium">{{ $item->nama }}</label>
                                <div class="">
                                    <select name="value[{{ $item->id }}]" id="criterita_{{ $item->id }}"
                                        class="form-control w-full p-3 border rounded-lg">
                                        <option value="" default>Pilih {{ $item->nama }}</option>
                                        @foreach ($item->subkriteria as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->nama }}</option>
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
                <div class="form-footer flex justify-between">
                    <p class="text-sm mt-3 tracking-wide">Pengajuan pada tanggal
                        <span class="text-primary-base font-medium">{{ Carbon\Carbon::now()->format('d M Y') }}</span>
                        oleh
                        <span class="text-primary-base">{{ Auth::user()->name }}</span>
                    </p>
                    <div class="form-action flex justify-end">
                        <button type="submit"
                            class="btn bg-primary-base text-white transition-all duration-200 px-10 py-3 font-semibold rounded-lg">Submit</button>
                    </div>

                </div>
            </form>
        </section>
    </main>
@endsection
