<x-navbar-layout>
    <x-slot:brand>
        <div class="brand flex items-center">
            <a href="{{ route('index') }}" class="flex items-center">
                <div class="brand pe-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="84" height="34" viewBox="0 0 84 34" fill="none">
                        <g clip-path="url(#a)" fill="#194F1F">
                            <path
                                d="M19.939.5a12.24 12.24 0 0 0-8.746 3.7l-7.57 7.733A12.77 12.77 0 0 0 0 20.866C0 27.844 5.538 33.5 12.369 33.5a12.24 12.24 0 0 0 8.746-3.7l5.236-5.349L41.608 8.867A5.85 5.85 0 0 1 45.785 7.1c2.623 0 4.847 1.746 5.618 4.163l4.815-4.919C54.02 2.83 50.169.5 45.785.5a12.24 12.24 0 0 0-8.746 3.7L16.546 25.133a5.85 5.85 0 0 1-4.177 1.767c-3.263 0-5.907-2.701-5.907-6.034a6.1 6.1 0 0 1 1.73-4.266l7.57-7.733A5.85 5.85 0 0 1 19.939 7.1c2.623 0 4.847 1.746 5.618 4.163l4.815-4.919C28.175 2.83 24.323.5 19.939.5" />
                            <path
                                d="M42.392 25.133a5.85 5.85 0 0 1-4.177 1.767c-2.623 0-4.846-1.746-5.617-4.162l-4.815 4.919C29.979 31.17 33.83 33.5 38.215 33.5a12.24 12.24 0 0 0 8.746-3.7L67.454 8.867A5.85 5.85 0 0 1 71.631 7.1c3.263 0 5.907 2.701 5.907 6.034a6.1 6.1 0 0 1-1.73 4.266l-7.57 7.733a5.85 5.85 0 0 1-4.177 1.767c-2.623 0-4.846-1.746-5.617-4.162l-4.815 4.918C55.825 31.17 59.677 33.5 64.06 33.5a12.24 12.24 0 0 0 8.746-3.7l7.57-7.733A12.77 12.77 0 0 0 84 13.134C84 6.156 78.462.5 71.631.5a12.24 12.24 0 0 0-8.746 3.7z" />
                        </g>
                        <defs>
                            <clipPath id="a">
                                <path fill="#fff" d="M0 .5h84v33H0z" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="ps-8 py-1 border-s-2 border-neutral-300">
                    <h1 class="text-primary-base font-medium leading-tight">Social Aid Decider</h1>
                </div>
            </a>
        </div>
    </x-slot:brand>
    <ul class="flex gap-10 items-center text-neutral-300">
        <li class="active-navbar hover:text-primary-base"><a href="{{ route('index') }}">
                <h1 class="leading-tight">Beranda</h1>
            </a></li>
        <li class="hover:text-primary-base"><a href="{{ route('auth.signIn') }}">
                <h1 class="leading-tight">Berita</h1>
            </a></li>
        <li class="hover:text-primary-base"><a href="{{ route('auth.signIn') }}">
                <h1 class="leading-tight">Tentang Kami</h1>
            </a></li>
    </ul>
    <x-slot:action>
        <a href="{{ route('auth.signIn') }}">
            <button onclick="window.utils.Animate.rippleEffect(event)"
                class="overflow-hidden relative bg-primary-base rounded-2xl">
                <h1 class="text-neutral-50 px-8 py-4 leading-tight">{{ Auth::user() ? 'Dashboard' : 'Sign In' }}</h1>
            </button>
        </a>
    </x-slot:action>
</x-navbar-layout>
