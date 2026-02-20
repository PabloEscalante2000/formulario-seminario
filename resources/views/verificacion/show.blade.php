@extends('layouts.app')

@section('title', 'Invitado confirmado')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800 mb-2">Invitado confirmado</h1>
            <p class="text-slate-500 mb-6">Esta persona tiene registro confirmado para el lanzamiento del libro.</p>

            <div class="text-left space-y-3 border-t border-slate-200 pt-6">
                <div>
                    <span class="text-sm font-medium text-slate-500">Nombre</span>
                    <p class="text-slate-800">{{ $registration->nombre }} {{ $registration->apellido }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-slate-500">Correo</span>
                    <p class="text-slate-800">{{ $registration->correo }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-slate-500">Acompañantes</span>
                    <p class="text-slate-800">{{ $registration->numero_acompanantes }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-slate-500">Fecha de registro</span>
                    <p class="text-slate-800">{{ $registration->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
