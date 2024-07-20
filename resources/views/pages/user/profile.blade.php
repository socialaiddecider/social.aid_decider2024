@extends('layouts.admin.sidebar')

@section('contents-admin')
    <section class="profile py-6 px-8 overflow-y-auto no-scrollbar bg-neutral-50 rounded-2xl m-4">
        <div class="header mb-6">
            <div class="image-profile w-full min-h-64 rounded-2xl relative flex justify-end items-stretch"
                x-ref="imageProfile" x-data="{
                    image: '',
                    images: {{ json_encode($images) }},
                    point: 0,
                    init() {
                        this.point = this.randomPoint()
                    },
                    change() {
                        this.image = this.images[this.point]
                        this.point = this.randomPoint()
                
                    },
                    randomPoint() {
                        return parseInt(Date.now() * Math.random()) % this.images.length
                    },
                }"
                style="background: url({{ $user->url_image }}); background-size:cover; background-position:bottom;"
                x-effect="console.log(image,images)">
                <div class="grid grid-rows-2 items-start">
                    <button type="button" class="backdrop-blur-sm backdrop-brightness-50 m-4 px-4 py-2 rounded-md"
                        @click="change(); $($refs.imageProfile).css('background-image','url('+$data.image+')');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"
                                stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="hidden">Regenerate</span>
                    </button>
                    <form action="{{ $updateBackgroundLocation }}" method="POST" class="self-end">
                        @csrf
                        <input type="text" x-model="image" name="image_back" hidden>
                        <button type="submit" class="backdrop-blur-sm backdrop-brightness-50 m-4 px-4 py-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10 2q-2.575.002-5.07.31A2.213 2.213 0 0 0 3 4.517V17.25a.75.75 0 0 0 1.075.676L10 15.082l5.926 2.844A.75.75 0 0 0 17 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41 41 0 0 0 10 2"
                                    fill="#fff" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="avatar-image absolute -bottom-14 left-9 inline-flex gap-2 items-end">
                    <div class="avatar image w-24 h-24 rounded-md relative"
                        style="background:url({{ $user->url_avatar }}); background-size:cover; background-position:center;">
                        <form action="{{ $updateAvatarLocation }}" method="POST" enctype='multipart/form-data'
                            class="absolute bottom-6 -right-8 z-20" x-data="{}" x-ref='avatarForm'>
                            @csrf
                            <label for="image">
                                <input type="file" class="hidden" name="image_avatar" id="image" accept="image/*"
                                    @change.prevent="$refs.avatarForm.submit()" />
                                <div
                                    class="absolute -bottom-10 right-5 cursor-pointer rounded-full bg-gray-500/80 fill-gray-300 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                                        <path
                                            d="M22.853 1.148a3.626 3.626 0 0 0-5.124 0L1.465 17.412A4.97 4.97 0 0 0 0 20.947V23a1 1 0 0 0 1 1h2.053a4.97 4.97 0 0 0 3.535-1.464L22.853 6.271a3.626 3.626 0 0 0 0-5.123M5.174 21.122A3.02 3.02 0 0 1 3.053 22H2v-1.053a2.98 2.98 0 0 1 .879-2.121L15.222 6.483l2.3 2.3ZM21.438 4.857l-2.506 2.507-2.3-2.295 2.507-2.507a1.623 1.623 0 1 1 2.295 2.3Z" />
                                    </svg>
                                </div>
                        </form>
                    </div>
                    <div class="text p-2">
                        <h1 class="text-neutral-base font-semibold text-lg leading-none mb-0.5  ">{{ $user->name }}</h1>
                        <p class="text-xs text-primary-base">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body p-4 mt-20 relative">
            <div class="profile-content">
                <div class="profile-info">
                    <form action="" method="POST">

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
