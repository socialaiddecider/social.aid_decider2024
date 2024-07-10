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

            <form action="{{ $updateLocation }}" method="POST" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <div class="form-header mb-5">
                    <h2 class="text-2xl">Ubah Data Berita</h2>
                </div>
                <div class="form-body mb-6">
                    <div class="field-text flex flex-col gap-4 mb-5">
                        <x-input-form key="title" placeholder="Masukkan judul berita" type="text" title="Judul Berita"
                            value="{{ $berita->title }}" />

                        <div class="textarea">
                            <div class="form-group flex flex-col gap-3">
                                <label for="description" class="text-neutral-950 font-medium">Deskripsi Berita</label>
                                <div class="">
                                    <textarea name="description" id="description" class="form-control w-full p-3 border rounded-lg"
                                        placeholder="Masukkan deskripsi berita" @required(true)>{{ $berita->description }}
                                    </textarea>
                                    @error('description')
                                        <div class="text-sm text-error-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <x-input-form key="category" placeholder="Masukkan kategori berita" type="text"
                            title="Kategori Berita" value="{{ $berita->category }}" />
                        <x-input-form key="url" placeholder="Masukkan url berita" type="text" title="URL Berita"
                            value="{{ $berita->url }}" />
                        <x-input-form key="author" placeholder="Masukkan author berita" type="text"
                            title="Author Berita" value="{{ $berita->author }}" />

                        <div class="image">
                            <h3 class="text-neutral-950 font-medium">Gambar Berita</h3>
                            <p class="text-sm font-light text-neutral-500">Pilih salah satu</p>
                            <div class="image_url ms-3 mt-2">
                                <label for="image" class="text-neutral-950 font-medium">URL Gambar Berita</label>
                                <input type="text" name="image" id="image_url"
                                    class="form-control w-full p-3 border rounded-lg mt-3"
                                    placeholder="Masukkan url gambar berita" value="{{ $berita->url_image }}">

                            </div>
                            <div class="image ms-3 mt-2">
                                <h3 class="text-neutral-950 font-medium mb-3">Upload Gambar Berita</h3>

                                <div class="w-[400px] relative border-2 border-gray-300 border-dashed rounded-lg p-6"
                                    x-ref="dropzone" x-data="{
                                        file: '',
                                        onfile: true,
                                        displayPreview(file) {
                                            let reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = () => {
                                                let preview = $refs.preview;
                                                preview.src = reader.result;
                                                preview.classList.remove('hidden');
                                                this.onfile = false;
                                            }
                                        }
                                    }" x-effect="console.log(file)"
                                    x-on:drop.prevent="file = $event.dataTransfer.files[0]; displayPreview(file);"
                                    x-on:dragleave.prevent="$($refs.dropzone).removeClass('border-primary-600')"
                                    x-on:dragover.prevent="$($refs.dropzone).addClass('border-primary-600')">
                                    <input type="file" class="absolute inset-0 w-full h-full opacity-0 z-50"
                                        @change="displayPreview($el.files[0])" name="image_file" />
                                    <div class="text-center" x-show="onfile">
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                                            <label for="file-upload" class="relative cursor-pointer">
                                                <span>Drag and drop</span>
                                                <span class="text-primary-base"> or browse</span>
                                                <span>to upload</span>
                                            </label>
                                        </h3>
                                        <p class="mt-1 text-xs text-gray-500">
                                            PNG, JPG, GIF up to 5MB
                                        </p>
                                    </div>

                                    <img src="" class="mt-4 mx-auto max-h-40 hidden" x-ref="preview">
                                </div>
                                @error('image_file')
                                    <div class="text-sm text-error-500">{{ $message }}</div>
                                @enderror
                            </div>

                            @error('image')
                                <div class="text-sm text-error-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="chosen-field">
                            <h3 class="text-neutral-950 font-medium">Status Berita</h3>
                            <div class="wrap flex">
                                <div class="form-group" id="status_news_publish">
                                    <div class="flex gap-10">
                                        <div class="inline-flex items-center">
                                            <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                                htmlFor="publish">
                                                <input name="status_news" type="radio"
                                                    class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary-200 text-neutral-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-primary-500 before:opacity-0 before:transition-opacity checked:border-primary-base checked:before:bg-primary-base hover:before:opacity-10"
                                                    id="publish" value="publish" @checked($berita->status == 'publish') />
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
                                                htmlFor="publish">
                                                Publish
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="status_news_draft">
                                    <div class="inline-flex items-center">
                                        <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                            htmlFor="draft">
                                            <input name="status_news" type="radio"
                                                class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary-200 text-gray-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-primary-500 before:opacity-0 before:transition-opacity checked:border-primary-base checked:before:bg-primary-base hover:before:opacity-10"
                                                id="draft" value="draft" @checked($berita->status == 'draft') />
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
                                            htmlFor="draft">
                                            Draft
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('criteria_type')
                                <div class="text-sm text-error-500">{{ $message }}</div>
                            @enderror
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
@push('scripts')
    <script></script>
@endpush
