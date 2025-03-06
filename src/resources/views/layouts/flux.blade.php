<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CMS' }}</title>
    <meta name="author" content="Darvis | Arvid de Jong | info@arvid.nl">
    <link rel="icon" type="image/png" href="/vendor/manta/default/img/favicon.png">

    <link rel="stylesheet" href="/libs/fontawesome-pro-6.5.2-web/css/all.css">

    <link rel="stylesheet" href="/libs/cropperjs/cropperjs.css">
    <link rel="stylesheet" href="/libs/flag-icons/css/flag-icons.min.css">

    {{-- Inter font family... --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@6.6.6/css/flag-icons.min.css">

    <script src="/libs/cropperjs/cropperjs.js"></script>
    <script src="/libs/sortablejs/sortablejs.min.js"></script>

    <script src="/libs/tinymce-7.6.0/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/vendor/manta/js/passive-events-tinymce.js"></script>

    <script>
        var tiny_css = '{{ env('TINY_CSS') }}'; //'/css/blaad.css';
    </script>

    <style>
        .tox-tinymce-aux {
            width: 100% !important;
        }

        [id]:target {
            background-color: yellow;
            /* Of een andere kleur naar keuze */
            transition: background-color 0.3s ease;
        }
    </style>
    @stack('styles')
    @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <x-manta.header-flux />
    {{ $slot }}
    <flux:toast position="top right" />
    {{-- <footer class="sticky bottom-0 p-4 text-center bg-white text-slate-400 dark:bg-zinc-800">
        {{ date('Y') }} <a href="https://arvid.nl">ARVID.NL</a>
    </footer> --}}
    @fluxScripts
    @stack('scripts')
    <script src="/vendor/manta/js/cms.js"></script>
    <script src="{{ env('SENTRY_REPLAY_URL') }}" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {});

        document.addEventListener('livewire:navigated', () => {});
    </script>
</body>

</html>
