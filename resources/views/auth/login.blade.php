@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="w-full max-w-md bg-white border border-gray-200 rounded-2xl p-8 mx-auto">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-12 h-12 text-red-600 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/><path d="M8 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <h2 class="text-2xl font-bold text-gray-900">Iniciar Sesión</h2>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold mb-1">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-base focus:ring-2 focus:ring-red-200 focus:border-red-400 transition @error('email') border-red-500 @enderror">
                @error('email')
                    <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold mb-1">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-base focus:ring-2 focus:ring-red-200 focus:border-red-400 transition @error('password') border-red-500 @enderror">
                @error('password')
                    <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm">
                    <input class="rounded border-gray-300 text-red-600 focus:ring-red-500" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2">Recordarme</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-red-600 hover:underline" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-full font-semibold text-base hover:bg-red-700 transition">Entrar</button>
        </form>
    </div>
</div>
@endsection
