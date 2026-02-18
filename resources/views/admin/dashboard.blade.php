@extends('layouts.app')

@section('title', 'Admin - Dashboard')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Panel de Administracion</h1>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-sm text-slate-500 hover:text-slate-700 transition cursor-pointer">Cerrar sesion</button>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-50 text-green-700 text-sm rounded-lg p-3 mb-6">{{ session('success') }}</div>
    @endif

    {{-- Crear token --}}
    <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">Tokens de invitacion</h2>
                <p class="text-sm text-slate-500">Genera un nuevo token para enviar a un invitado.</p>
            </div>
            <form method="POST" action="{{ route('admin.tokens.create') }}">
                @csrf
                <button type="submit"
                    class="bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                    Generar token
                </button>
            </form>
        </div>
    </div>

    {{-- Tabla de tokens --}}
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="text-lg font-semibold text-slate-800">Tokens ({{ $tokens->count() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">Token</th>
                        <th class="px-6 py-3 text-left font-medium">Estado</th>
                        <th class="px-6 py-3 text-left font-medium">Enlace</th>
                        <th class="px-6 py-3 text-left font-medium">Creado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($tokens as $invitationToken)
                        <tr>
                            <td class="px-6 py-3 font-mono text-xs text-slate-600">{{ Str::limit($invitationToken->token, 20) }}</td>
                            <td class="px-6 py-3">
                                @if ($invitationToken->isAvailable())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Disponible</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">Usado</span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                @if ($invitationToken->isAvailable())
                                    <input type="text" readonly value="{{ route('invitation.show', $invitationToken->token) }}"
                                        class="text-xs bg-slate-50 border border-slate-200 rounded px-2 py-1 w-64 text-slate-600 select-all">
                                @else
                                    <span class="text-xs text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-slate-500">{{ $invitationToken->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400">No hay tokens creados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabla de registros --}}
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="text-lg font-semibold text-slate-800">Registros ({{ $registrations->count() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium">Nombre</th>
                        <th class="px-6 py-3 text-left font-medium">Correo</th>
                        <th class="px-6 py-3 text-left font-medium">Que espera del seminario</th>
                        <th class="px-6 py-3 text-left font-medium">Acompanantes</th>
                        <th class="px-6 py-3 text-left font-medium">Fecha</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($registrations as $registration)
                        <tr>
                            <td class="px-6 py-3 text-slate-800">{{ $registration->nombre }} {{ $registration->apellido }}</td>
                            <td class="px-6 py-3 text-slate-600">{{ $registration->correo }}</td>
                            <td class="px-6 py-3 text-slate-600 max-w-xs truncate">{{ $registration->pregunta }}</td>
                            <td class="px-6 py-3 text-slate-600">{{ $registration->numero_acompanantes }}</td>
                            <td class="px-6 py-3 text-slate-500">{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">No hay registros aun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
