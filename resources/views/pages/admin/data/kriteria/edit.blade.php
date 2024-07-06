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
                    <h2 class="text-2xl">Tambahkan Data Kriteria</h2>
                </div>
                <div class="form-body mb-6">
                    <div class="field-text flex flex-col gap-4 mb-5">
                        <x-input-form key="criteria_code" placeholder="Masukkan kode kriteria" type="text"
                            title="Kode Kriteria" value="{{ $kriteria->kode_kriteria }}" />
                        <x-input-form key="criteria_name" placeholder="Masukkan nama kriteria" type="text"
                            title="Nama Kriteria" value="{{ $kriteria->nama }}" />
                    </div>
                    <div class="chosen-field">
                        <h3 class="text-neutral-950 font-medium">Jenis Kriteria</h3>
                        <div class="wrap flex">
                            <div class="form-group" id="criteria_type_benefit">
                                <div class="flex gap-10">
                                    <div class="inline-flex items-center">
                                        <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                            htmlFor="benefit">
                                            <input name="criteria_type" type="radio"
                                                class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary-200 text-neutral-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-primary-500 before:opacity-0 before:transition-opacity checked:border-primary-base checked:before:bg-primary-base hover:before:opacity-10"
                                                id="benefit" value="benefit" @checked($kriteria->jenis == 'benefit') />
                                            <span
                                                class="absolute text-primary-base transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                    viewBox="0 0 16 16" fill="currentColor">
                                                    <circle data-name="ellipse" cx="8" cy="8" r="8">
                                                    </circle>
                                                </svg>
                                            </span>
                                        </label>
                                        <label class="mt-px font-light text-gray-700 cursor-pointer select-none"
                                            htmlFor="benefit">
                                            Benefit
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="criteria_type_cost">
                                <div class="inline-flex items-center">
                                    <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                        htmlFor="cost">
                                        <input name="criteria_type" type="radio"
                                            class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary-200 text-gray-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-primary-500 before:opacity-0 before:transition-opacity checked:border-primary-base checked:before:bg-primary-base hover:before:opacity-10"
                                            id="cost" value="cost" @checked($kriteria->jenis == 'cost') />
                                        <span
                                            class="absolute text-primary-base transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16"
                                                fill="currentColor">
                                                <circle data-name="ellipse" cx="8" cy="8" r="8">
                                                </circle>
                                            </svg>
                                        </span>
                                    </label>
                                    <label class="mt-px font-light text-gray-700 cursor-pointer select-none" htmlFor="cost">
                                        Cost
                                    </label>
                                </div>
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
