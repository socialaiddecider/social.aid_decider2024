<div class=" bg-primary-base">
    <footer class="px-20 pb-24 pt-20 flex flex-col gap-14">
        <div id="footer-body" class="flex justify-between text-white">
            <div class="flex gap-32">
                {{ $body }}
            </div>
            <div class="">
                {{ $action }}
            </div>
        </div>
        <div id="footer-below" class="pt-9 border-t border-neutral-50">
            <div class="grid grid-cols-3 w-full justify-between items-center">
                <div class="brand-footer fill-white">
                    {!! file_get_contents($brandLogo) !!}
                </div>
                <div class="footer-below-link flex gap-8 justify-self-center">
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
                        <div class="fill-neutral-50 p-4  border rounded-full border-neutral-50">
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
        </div>
    </footer>
</div>
