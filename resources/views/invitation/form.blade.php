@extends('layouts.app')

@section('title', 'Invitacion al Seminario')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="w-full max-w-lg">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-slate-800">Seminario</h1>
                <p class="text-slate-500 mt-2">El Amor es un Delirio</p>
                <a href="https://seminario.elamoresundelirio.com" class="text-indigo-600 text-sm hover:underline mt-1 inline-block" target="_blank" rel="noopener noreferrer">seminario.elamoresundelirio.com</a>
            </div>

            <form method="POST" action="{{ route('invitation.store', $token) }}" class="space-y-5">
                @csrf

                <div>
                    <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                        required>
                    @error('nombre')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="apellido" class="block text-sm font-medium text-slate-700 mb-1">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                        required>
                    @error('apellido')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="correo" class="block text-sm font-medium text-slate-700 mb-1">Correo electronico</label>
                    <input type="email" name="correo" id="correo" value="{{ old('correo') }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                        required>
                    @error('correo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="pregunta" class="block text-sm font-medium text-slate-700 mb-1">Que esperas del seminario?</label>
                    <textarea name="pregunta" id="pregunta" rows="4"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none"
                        required>{{ old('pregunta') }}</textarea>
                    @error('pregunta')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="numero_acompanantes" class="block text-sm font-medium text-slate-700 mb-1">Numero de acompanantes</label>
                    <input type="number" name="numero_acompanantes" id="numero_acompanantes" value="{{ old('numero_acompanantes', 0) }}" min="0" max="10"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                        required>
                    @error('numero_acompanantes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                    Confirmar asistencia
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
