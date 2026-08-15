<!DOCTYPE html>
<html lang="fr">

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
    </style>

    {{-- Styles de la page --}}
    @yield('styles')
</head>

<body>

    {{-- Contenu de la page --}}
    @yield('content')

    {{-- Scripts globaux --}}
    <script>
        // Token CSRF pour les requêtes AJAX
        window.csrfToken = '{{ csrf_token() }}';
    </script>

    @stack('scripts')

</body>

</html>