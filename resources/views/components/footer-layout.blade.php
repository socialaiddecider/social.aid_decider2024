<div class=" bg-primary-base">
    <footer class="px-6 md:px-20 pb-24 pt-20 flex flex-col gap-14">
        <div id="footer-body" class="flex flex-col md:flex-row gap-10 justify-between text-white">
            <div class="flex flex-wrap gap-5 sm:gap-10 md:gap-32">
                {{ $body }}
            </div>
            <div class="">
                {{ $action }}
            </div>
        </div>
        <div id="footer-below" class="pt-9 border-t border-neutral-50">
            {{ $bellow }}
        </div>
    </footer>
</div>
