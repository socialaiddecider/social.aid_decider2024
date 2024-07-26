@php
    $brandLogo = Vite::asset('resources/assets/brand/brandLogo.svg');
@endphp


<x-navbar-layout>
    <x-slot:brand>
        <div class="brand flex items-center">
            <a href="{{ route('index') }}" class="flex items-center">
                <div class="brand pe-8 fill-primary-base">
                    {!! file_get_contents($brandLogo) !!}
                </div>
                <div class="ps-8 py-1 border-s-2 xl:block hidden border-neutral-300">
                    <h1 class="text-primary-base font-medium leading-tight">Social Aid Decider</h1>
                </div>
            </a>
        </div>
    </x-slot:brand>
    <ul class="gap-10 items-center text-neutral-300 flex" :class="dropdown ? 'flex-col ' : ''">
        <li class="hover:text-primary-base" id="nav-hero"><a href="{{ route('index') }}">
                <h1 class="leading-tight">Beranda</h1>
            </a></li>
        <li class="hover:text-primary-base" id="nav-news"><a href="{{ route('index', '#news') }}">
                <h1 class="leading-tight">Berita</h1>
            </a></li>
        <li class="hover:text-primary-base text-nowrap" id="nav-team"><a href="{{ route('index', '#team') }}">
                <h1 class="leading-tight">Tentang Kami</h1>
            </a></li>
    </ul>
    <x-slot:action>
        <a href="{{ route('auth.signIn') }}">
            <button type="button" onclick="window.utils.Animate.ripple.rippleEffect(event)"
                class="overflow-hidden relative bg-primary-base rounded-2xl">
                <h1 class="text-neutral-50 px-8 py-4 leading-tight">{{ Auth::user() ? 'Dashboard' : 'Sign In' }}</h1>
            </button>
        </a>
    </x-slot:action>
</x-navbar-layout>
