<div class="w-full px-10 py-8 sticky top-0 z-40">
    <nav class="w-full grid grid-cols-3 bg-white shadow-baseShadow px-8 py-4 rounded-2xl">
        <div class="nav-brand flex items-center">
            {{ $brand }}
        </div>
        <div class="nav-body justify-self-center flex items-center">
            {{ $slot }}
        </div>
        <div class="nav-action justify-self-end flex items-center">
            {{ $action }}
        </div>
    </nav>
</div>
