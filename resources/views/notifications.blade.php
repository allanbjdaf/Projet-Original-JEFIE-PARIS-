<!DOCTYPE html>

@php
if (request()->has('locale')) {
$requestedLocale = request('locale');
if (in_array($requestedLocale, ['en', 'fr', 'de', 'zh', 'it', 'pt'])) {
session(['locale' => $requestedLocale]);
}
}
app()->setLocale(session('locale', 'fr'));
@endphp



<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Forum International de l\'Innovation 2026')</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/263.png') }}">

    {{-- Reset CSS minimal --}}
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        img {
            max-width: 100%;
            display: block;
        }

        a {
            text-decoration: none;
        }

        button {
            cursor: pointer;
            font-family: inherit;
        }

        input,
        select,
        textarea {
            font-family: inherit;
        }

        ul,
        ol {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Style basique pour le message flash (évite d'avoir besoin de Tailwind/Bootstrap) */
        .flash-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            background-color: #10B981;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: opacity 0.3s ease;
            font-family: sans-serif;
        }

        .flash-close {
            background: none;
            border: none;
            color: white;
            font-weight: bold;
            font-size: 18px;
            padding: 0;
        }
    </style>

    {{-- Styles de la page --}}
    @yield('styles')
</head>

<body>

    {{-- Affichage dynamique du message flash de succès --}}
    @if(session('success'))
    <div id="flash-message" class="flash-alert">
        <span>{{ session('success') }}</span>
        <button onclick="document.getElementById('flash-message').remove()" class="flash-close">&times;</button>
    </div>
    @endif

    {{-- Contenu de la page --}}
    @yield('content')

    {{-- Scripts globaux --}}
    <script>
        // Token CSRF pour les requêtes AJAX
        window.csrfToken = '{{ csrf_token() }}';

        // Auto-disparition du message flash après 4 secondes
        document.addEventListener('DOMContentLoaded', function() {
            const flash = document.getElementById('flash-message');
            if (flash) {
                setTimeout(() => {
                    flash.style.opacity = '0';
                    setTimeout(() => flash.remove(), 300);
                }, 4000);
            }
        });
    </script>

    {{-- Reçoit le script de toggleLang() poussé depuis vos autres vues --}}
    @stack('scripts')


</body>

</html>