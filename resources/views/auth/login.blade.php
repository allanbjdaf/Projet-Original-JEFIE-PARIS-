<x-guest-layout>
    <!-- Les conteneurs superflus ont été retirés car ils existent déjà dans guest.blade.php -->

    <!-- BLOC LOGO ENTREPRISE -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/264.png') }}" alt="Logo Entreprise" class="h-20 w-auto object-contain">
    </div>

    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Connexion</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input class="w-full p-2 border rounded-lg" id="email" type="email" name="email" required autofocus>
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mot de passe</label>
            <input class="w-full p-2 border rounded-lg" id="password" type="password" name="password" required>
        </div>

        <!-- Se souvenir de moi -->
        <div class="flex items-center justify-between mb-6">
            <label class="inline-flex items-center text-sm text-gray-600">
                <input type="checkbox" name="remember" class="rounded border-gray-300">
                <span class="ml-2">Se souvenir de moi</span>
            </label>
            @if (Route::has('password.request'))
            <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                Mot de passe oublié ?
            </a>
            @endif
        </div>

        <!-- Bouton -->
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-lg font-bold hover:bg-blue-700 transition">
            Se connecter
        </button>
    </form>
</x-guest-layout>