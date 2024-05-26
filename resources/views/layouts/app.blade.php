<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name', 'Social Aid Decider') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-PlusJakartaSans no-scrollbar relative overflow-hidden bg-neutral-100/20 antialiased">
    @yield('contents')
    @stack('modals')
    @stack('scripts')
</body>

</html>
