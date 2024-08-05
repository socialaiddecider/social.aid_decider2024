@php
    $brandLogo = Vite::asset('resources/assets/brand/brandLogo.svg');

    $belowLinks = [
        'Terms' => '#',
        'Privacy' => '#',
        'Cookie' => '#',
    ];

    $sosmedLinks = [
        'LinkedIn' => ['link' => '#', 'icon' => Vite::asset('resources/assets/icons/sosmedIcons/linkedIn.svg')],
        'Facebook' => ['link' => '#', 'icon' => Vite::asset('resources/assets/icons/sosmedIcons/facebook.svg')],
        'Instagram' => [
            'link' =>
                'https://www.instagram.com/social_aid.decider?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
            'icon' => Vite::asset('resources/assets/icons/sosmedIcons/instagram.svg'),
        ],
        'Tiktok' => ['link' => '#', 'icon' => Vite::asset('resources/assets/icons/sosmedIcons/tiktok.svg')],
    ];

    $productLinks = [
        'Employee database' => '#',
        'Kalkulasi' => '#',
        'Artifcial Intelegence' => '#',
    ];

    $informationLinks = [
        'FAQ' => '#',
        'Blog' => '#',
        'Support' => '#',
    ];

    $companyLinks = [
        'About Us' => '#',
        'Careers' => '#',
        'Contact Us' => '#',
        'Partners' => '#',
    ];
@endphp

<footer>
    <x-footer-layout>
        <x-slot:body>
            <div class="product-links">
                <h1 class="font-bold mb-4">Product</h1>
                <ul>
                    @foreach ($productLinks as $link => $url)
                        <li class="mb-3">
                            <a href="{{ $url }}">
                                <h6 class="font-normal">{{ $link }}</h6>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="information-links">
                <h1 class="font-bold mb-4">Information</h1>
                <ul>
                    @foreach ($informationLinks as $link => $url)
                        <li class="mb-3">
                            <a href="{{ $url }}">
                                <h6 class="font-normal">{{ $link }}</h6>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="company-links">
                <h1 class="font-bold mb-4">Company</h1>
                <ul>
                    @foreach ($companyLinks as $link => $url)
                        <li class="mb-3">
                            <a href="{{ $url }}">
                                <h6 class="font-normal">{{ $link }}</h6>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-slot:body>
        <x-slot:action>
            <div class="action-subcription text-start bg-neutral-50/10 py-8 px-11 ">
                <h1 class="font-bold mb-4">Subscribe</h1>
                <div class="form-subscription">
                    <form action="" class="flex items-center rounded-md relative overflow-hidden mb-5">
                        <input type="text" class="p-4 focus:outline-none text-neutral-300 rounded-md w-4/5"
                            placeholder="Email address">
                        <button type="submit"
                            class="focus:border-none bg-primary-400 absolute end-0 top-0 bottom-0 ps-[18px] pe-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 fill-white">
                                <path
                                    d="m17.414 10.586-4.293-4.293-1.414 1.414L15 11H5v2h10l-3.293 3.293 1.414 1.414 4.293-4.293a2 2 0 0 0 0-2.828"
                                    data-name="01 align center" />
                            </svg>
                        </button>
                    </form>
                    <p class="max-w-64 text-xs text-neutral-50/60 font-normal leading-relaxed ">Hello, we are Social Aid
                        Decider. Our goal is
                        to translate
                        the positive
                        effects
                        from
                        revolutionizing how companies engage with their clients & their team.</p>
                </div>
            </div>
        </x-slot:action>
        <x-slot:bellow>
            <div class="grid grid-cols-2 lg:grid-cols-3 w-full justify-between items-center">
                <div class="brand-footer fill-white">
                    {!! file_get_contents($brandLogo) !!}
                </div>
                <div class="footer-below-link gap-8 justify-self-center hidden lg:flex">
                    @foreach ($belowLinks as $link => $url)
                        <div class="text-neutral-50 text-sm font-medium">
                            <a href="{{ $url }}">
                                <h6>{{ $link }}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="footer-below-sosmed flex gap-2 justify-self-end">
                    @foreach ($sosmedLinks as $sosmed => $data)
                        <div class="fill-neutral-50 p-2 md:p-4 lg:border rounded-full border-neutral-50">
                            <a href="{{ $data['link'] }}">
                                <div class="w-5 h-5">
                                    {!! file_get_contents($data['icon']) !!}
                                </div>
                                <p class="sr-only">{{ $sosmed }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-slot:bellow>
    </x-footer-layout>
</footer>
