<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CMS' }}</title>
    <meta name="author" content="Darvis | Arvid de Jong | info@arvid.nl">
    <link rel="icon" type="image/png" href="/vendor/manta/default/img/favicon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="min-h-screen antialiased bg-white dark:bg-zinc-800">

    {{ $slot }}

    <flux:toast position="top right" />

    @fluxScripts
    @stack('scripts')
    <!-- Dubbel aanroepen van @fluxScripts is niet nodig, daarom verwijderen we de tweede -->
</body>

</html>
