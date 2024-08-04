<div class="bg-neutral-50 rounded-2xl m-4 py-6 px-8">
    <div class="header mb-32 sm:mb-6">
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

            <div
                class="avatar-image absolute -bottom-28 md:-bottom-14 left-3 md:left-9 inline-flex flex-col sm:flex-row gap-5 sm:gap-2 sm:items-end">
                <div class="avatar image w-24 h-24 rounded-md relative"
                    style="background:url({{ $user->url_avatar }}); background-size:cover; background-position:center;">
                    <img src="{{ Auth::user()->url_avatar }}" class="rounded-md" alt="">
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
                            @error('image_avatar')
                                <div class="text-red-500 text-xs absolute z-50 text-nowrap -bottom-10 left-0">
                                    {{ $message }}</div>
                            @enderror
                    </form>
                </div>
                <div class="text p-2 w-auto">
                    <h1 class="text-neutral-base font-semibold text-md md:text-lg leading-none mb-0.5  ">
                        {{ $user->name }}
                    </h1>
                    <p class="text-[10px] hidden sm:block md:text-xs text-primary-base">
                        {{ $user->email }}
                    </p>
                    <p class="text-[10px] sm:hidden text-primary-base">{{ '@' . explode('@', $user->email)[0] }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body p-0 md:p-4 mt-20 relative">
        <div class="profile-content grid gap-5 divide-y md:grid-cols-2 md:divide-y-0 md:divide-x">
            <div class="profile-info p-0 md:px-4 py-2">
                <div class="header mb-4">
                    <h2 class="text-lg font-bold">Profile </h2>
                </div>
                <form action="{{ $updateProfileLocation }}" method="POST">
                    @csrf
                    <div class="grid grid-flow-row gap-4">
                        <x-input-form key="username" type="text" placeholder="username" title="Username"
                            :value="$user->username" disabled=true />
                        <div class="grid grid-flow-row gap-2">
                            <x-input-form key="nkk" type="text" placeholder="nkk" title="NKK"
                                :value="$user->nkk" />
                            <x-input-form key="name" type="text" placeholder="nama lengkap" title="Nama Lengkap"
                                :value="$user->name" />
                            <x-input-form key="email" type="email" placeholder="email" title="Email"
                                :value="$user->email" />
                            <x-input-form key="address" type="text" placeholder="alamat" title="Alamat"
                                :value="$user->address" />

                        </div>
                    </div>
                    <div class="form-action flex my-4 justify-end">
                        <button type="submit"
                            class="btn bg-primary-base text-white transition-all duration-200 px-6 py-3 font-semibold rounded-lg">Perbarui
                            Profile</button>
                    </div>
                </form>
            </div>
            <div class="change-password px-0 md:px-4 py-2">
                <div class="header mb-4">
                    <h2 class="text-lg font-bold">Perbarui Password</h2>
                </div>
                <form action="{{ $updatePasswordLocation }}" method="POST">
                    @csrf
                    <div class="grid grid-flow-row gap-4">
                        <x-input-form key="current_password" type="password" placeholder="password"
                            title="Password Saat Ini" />
                        <div class="grid grid-flow-row gap-2">
                            <x-input-form key="new_password" type="password" placeholder="password"
                                title="Password Baru" />
                            <x-input-form key="new_password_confirmation" type="password" placeholder="password"
                                title="Konfirmasi Password Baru" />
                        </div>
                    </div>
                    <div class="form-action flex my-4 justify-end">
                        <button type="submit"
                            class="btn bg-primary-base text-white transition-all duration-200 px-6 py-3 font-semibold rounded-lg">Perbarui
                            Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
