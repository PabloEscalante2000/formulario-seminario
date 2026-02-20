@extends('layouts.app')

@section('title', 'Registro exitoso')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <img src="/images/itas_icono.png" alt="ITAS" class="mx-auto w-20 mb-4">
            <div class="mx-auto w-16 h-16 bg-brand-gold/20 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-brand-black mb-2">¡Registro exitoso!</h1>
            <p class="text-neutral-500 mb-6">Tu asistencia al lanzamiento del libro ha sido confirmada. ¡Te esperamos!</p>

            <div class="bg-neutral-50 rounded-xl p-4 text-sm text-neutral-700 space-y-2 text-left">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span><strong>Fecha:</strong> 27 de marzo</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span><strong>Hora:</strong> 7:00 p.m.</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span><strong>Lugar:</strong> Hotel Los Delfines - Miraflores</span>
                </div>
            </div>

            <p class="text-neutral-400 text-xs mt-4">Revisa tu correo para ver tu código QR de entrada.</p>
        </div>
    </div>
</div>
@endsection
