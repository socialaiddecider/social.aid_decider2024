<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ Vite::asset('resources/assets/favicon/apple-touch-icon.png') }} ">
    <link rel="icon" href="{{ Vite::asset('resources/assets/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ Vite::asset('resources/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ Vite::asset('resources/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ Vite::asset('resources/assets/favicon/site.webmanifest') }}">
    <title>{{ config('app.name', 'Social Aid Decider') }}</title>
    {{-- this for import assets from vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- push all the styles --}}
    @stack('styles')
</head>

<body class="font-PlusJakartaSans no-scrollbar relative overflow-hidden bg-neutral-100 antialiased">
    {{-- get all the contents --}}
    @yield('contents')
    {{-- push all the modals --}}
    @stack('modals')
    {{-- push all the scripts --}}
    @stack('scripts')

</body>

</html>
