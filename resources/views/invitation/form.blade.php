@extends('layouts.app')

@section('title', 'Invitacion al Lanzamiento del Libro')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="w-full max-w-lg">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <img src="/images/itas_icono.png" alt="ITAS" class="mx-auto w-24 mb-4">
                <h1 class="text-3xl font-bold text-brand-black">Lanzamiento del Libro</h1>
                <p class="text-brand-brown mt-2 font-medium">El Amor es un Delirio</p>
                <a href="https://elamoresundelirio.com" class="text-brand-gold text-sm hover:underline mt-1 inline-block" target="_blank" rel="noopener noreferrer">elamoresundelirio.com</a>
            </div>

            <form method="POST" action="{{ route('invitation.store', $token) }}" class="space-y-5">
                @csrf

                <div>
                    <label for="nombre" class="block text-sm font-medium text-neutral-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                        class="w-full rounded-lg border border-neutral-300 px-4 py-2.5 text-brand-black focus:border-brand-gold focus:ring-2 focus:ring-brand-gold/30 outline-none transition"
                        required>
                    @error('nombre')
                        <p class="text-brand-brown text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="apellido" class="block text-sm font-medium text-neutral-700 mb-1">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}"
                        class="w-full rounded-lg border border-neutral-300 px-4 py-2.5 text-brand-black focus:border-brand-gold focus:ring-2 focus:ring-brand-gold/30 outline-none transition"
                        required>
                    @error('apellido')
                        <p class="text-brand-brown text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="correo" class="block text-sm font-medium text-neutral-700 mb-1">Correo electrónico</label>
                    <input type="email" name="correo" id="correo" value="{{ old('correo') }}"
                        class="w-full rounded-lg border border-neutral-300 px-4 py-2.5 text-brand-black focus:border-brand-gold focus:ring-2 focus:ring-brand-gold/30 outline-none transition"
                        required>
                    @error('correo')
                        <p class="text-brand-brown text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="celular" class="block text-sm font-medium text-neutral-700 mb-1">Número de celular</label>
                    <input type="tel" name="celular" id="celular" value="{{ old('celular') }}"
                        class="w-full rounded-lg border border-neutral-300 px-4 py-2.5 text-brand-black focus:border-brand-gold focus:ring-2 focus:ring-brand-gold/30 outline-none transition"
                        required>
                    @error('celular')
                        <p class="text-brand-brown text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="pregunta" class="block text-sm font-medium text-neutral-700 mb-1">¿Qué esperas del lanzamiento? <span class="text-neutral-400 font-normal">(opcional)</span></label>
                    <textarea name="pregunta" id="pregunta" rows="3"
                        class="w-full rounded-lg border border-neutral-300 px-4 py-2.5 text-brand-black focus:border-brand-gold focus:ring-2 focus:ring-brand-gold/30 outline-none transition resize-none">{{ old('pregunta') }}</textarea>
                    @error('pregunta')
                        <p class="text-brand-brown text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="numero_acompanantes" class="block text-sm font-medium text-neutral-700 mb-1">Número de acompañantes</label>
                    <input type="number" name="numero_acompanantes" id="numero_acompanantes" value="{{ old('numero_acompanantes', 0) }}" min="0" max="10"
                        class="w-full rounded-lg border border-neutral-300 px-4 py-2.5 text-brand-black focus:border-brand-gold focus:ring-2 focus:ring-brand-gold/30 outline-none transition"
                        required>
                    @error('numero_acompanantes')
                        <p class="text-brand-brown text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-brand-black text-white font-semibold py-3 rounded-lg hover:bg-neutral-800 transition cursor-pointer">
                    Confirmar asistencia
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
