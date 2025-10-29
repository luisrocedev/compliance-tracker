<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS CDN (Play CDN recomendado) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Script IA predicción (AJAX) -->
    <script src="{{ asset('js/ia-prediccion.js') }}" defer></script>
</head>

<body>
    <div id="app">
        <nav class="bg-white border-b border-gray-100 shadow-sm">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <a class="text-2xl font-extrabold tracking-tight text-black hover:text-red-600 transition-colors duration-200" href="{{ route('dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div>
                    <ul class="flex space-x-6 items-center">
                        @guest
                        @if (Route::has('login'))
                        <li>
                            <a class="text-gray-700 hover:text-red-600 font-semibold transition-colors duration-200" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li>
                            <a class="text-gray-700 hover:text-red-600 font-semibold transition-colors duration-200" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="relative group">
                            <a href="{{ route('dashboard') }}" class="text-black hover:text-red-600 font-bold text-lg px-3 py-1 rounded transition-colors duration-200">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-50">
                                <a class="block px-4 py-2 text-gray-700 hover:bg-red-100" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-8 min-h-screen bg-white container mx-auto px-4">
            @yield('content')
        </main>
    </div>
</body>

</html>