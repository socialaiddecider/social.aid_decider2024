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
        @if (Auth::user()?->role === 'user')
            <li class="hover:text-primary-base text-nowrap"><a href="{{ route('user.pengajuan.index') }}">
                    <h1 class="leading-tight">Pengajuan Penilaian</h1>
                </a></li>
        @endif
        <li class="hover:text-primary-base text-nowrap" id="nav-team"><a href="{{ route('index', '#team') }}">
                <h1 class="leading-tight">Tentang Kami</h1>
            </a></li>

    </ul>
    <x-slot:action>
        @if (Auth::user()?->role === 'admin')
            <a href="{{ Auth::user() ? route('admin.dashboard') : route('auth.signIn') }}">
                <button type="button" onclick="window.utils.Animate.ripple.rippleEffect(event)"
                    class="overflow-hidden relative bg-primary-base rounded-2xl">
                    <h1 class="text-neutral-50 px-8 py-4 leading-tight">{{ Auth::user() ? 'Dashboard' : 'Sign In' }}
                    </h1>
                </button>
            </a>
        @elseif (Auth::user())
            <div class="profile flex ps-6 items-center">

                <div class="action relative" x-data="{ isDropdownOpen: false }">
                    <button type="button" class="flex items-center" @click="isDropdownOpen = !isDropdownOpen">
                        <div class="profile-image w-10 h-10 rounded-full me-2 overflow-hidden"
                            style="background: url({{ Auth::user()->url_avatar }});background-size:cover; background-position:center;">
                            <img src="{{ Auth::user()->url_avatar }}" alt="">
                        </div>
                    </button>
                    <div class="z-50 dropdown shadow-lg absolute w-fit bg-neutral-50 rounded-lg p-4 left-0 md:right-0 top-16"
                        x-show="isDropdownOpen" @click.away="isDropdownOpen = false" x-cloak>
                        <div class="min-w-40">
                            <div class="min-w-full border-b pb-3">
                                <a href="{{ route('user.profile.index') }}"
                                    class="w-full text-nowrap rounded-md hover:bg-neutral-200 transition-all p-2 inline-flex gap-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 18 22" fill="none">
                                        <path class="stroke-neutral-base"
                                            d="M12.75 5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0M1.501 19.118a7.5 7.5 0 0 1 14.998 0A17.9 17.9 0 0 1 9 20.75c-2.676 0-5.216-.584-7.499-1.632"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="text-sm font-medium text-neutral-base">
                                        Profile
                                    </span>
                                </a>
                            </div>
                            <a href="{{ route('auth.signOut') }}"
                                class="w-full text-nowrap rounded-md hover:bg-neutral-200 transition-all p-2 inline-flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"
                                        stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span class="text-sm font-medium text-neutral-base">
                                    Sign Out
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('auth.signIn') }}">
                <button type="button" onclick="window.utils.Animate.ripple.rippleEffect(event)"
                    class="overflow-hidden relative bg-primary-base rounded-2xl">
                    <h1 class="text-neutral-50 px-8 py-4 leading-tight">Sign In</h1>
                </button>
            </a>
        @endif
    </x-slot:action>
</x-navbar-layout>
