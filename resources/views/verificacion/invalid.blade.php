@extends('layouts.app')

@section('title', 'Verificacion invalida')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800 mb-2">Verificacion invalida</h1>
            <p class="text-slate-500">No se encontro un registro asociado a este codigo. Verifica que el enlace sea correcto.</p>
        </div>
    </div>
</div>
@endsection
