@extends('layouts.app')

@section('title', 'Admin - Login')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="w-full max-w-sm">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h1 class="text-2xl font-bold text-slate-800 text-center mb-6">Panel de Administracion</h1>

            @error('email')
                <div class="bg-red-50 text-red-600 text-sm rounded-lg p-3 mb-4">{{ $message }}</div>
            @enderror

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Correo</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                        required autofocus>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Contrasena</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                    Iniciar sesion
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
