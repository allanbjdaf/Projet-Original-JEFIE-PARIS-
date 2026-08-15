{{-- ══════════════════════════════════════════════════════════════
     resources/views/layouts/app.blade.php
     REMPLACER ENTIÈREMENT votre fichier layouts/app.blade.php
     Solution : supprimer @vite et le CSS Breeze de toutes vos pages
══════════════════════════════════════════════════════════════ --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JEFIE — Paris 2026')</title>

    {{-- ✅ PAS de @vite ici — évite que Tailwind Breeze écrase votre CSS --}}
    {{-- ✅ PAS de @stack('styles') Breeze --}}

    {{-- Vos styles inline de chaque page --}}
    @yield('styles')
</head>

<body>
    {{-- Contenu de chaque page --}}
    @yield('content')

    {{-- Scripts --}}
    @stack('scripts')
</body>

</html>