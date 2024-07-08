<div class="w-full px-10 pt-8 sticky top-0 z-30 backdrop-blur-md mb-14">
    <nav class="w-full grid grid-cols-2 md:grid-cols-3 bg-white/95 backdrop-opacity-60 shadow-baseShadow px-8 py-4 rounded-2xl"
        x-data="{ dropdown: false }">
        <div class="nav-brand flex items-center">
            {{ $brand }}
        </div>
        <button class="z-50 md:hidden order-last justify-self-end" @click="dropdown = !dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                <rect y=".5" width="32" height="32" rx="2.667" fill="#194F1F" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M4 9.5a1 1 0 0 1 1-1h22a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1m0 7a1 1 0 0 1 1-1h22a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1m0 7a1 1 0 0 1 1-1h22a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1"
                    fill="#fff" />
            </svg>
        </button>
        <div x-show="dropdown" class="fixed flex -left-10 -top-10 w-screen h-screen bg-neutral-50"></div>
        <div :class="dropdown ? 'absolute top-28' : 'hidden'"
            class="md:flex nav-body grow justify-self-center items-center">
            {{ $slot }}
        </div>
        <div :class="dropdown ? 'absolute left-0 top-3' : 'hidden'"
            class="md:flex nav-action justify-self-end flex items-center">
            {{ $action }}
        </div>

    </nav>
</div>
