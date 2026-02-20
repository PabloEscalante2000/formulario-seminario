@extends('layouts.app')

@section('title', 'Verificacion invalida')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <div class="mx-auto w-16 h-16 bg-brand-brown/20 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-brand-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-brand-black mb-2">Verificación inválida</h1>
            <p class="text-neutral-500">No se encontró un registro asociado a este código. Verifica que el enlace sea correcto.</p>
        </div>
    </div>
</div>
@endsection
