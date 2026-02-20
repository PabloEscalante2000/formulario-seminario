@extends('layouts.app')

@section('title', 'Admin - Dashboard')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Panel de Administración</h1>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-sm text-slate-500 hover:text-slate-700 transition cursor-pointer">Cerrar sesión</button>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-50 text-green-700 text-sm rounded-lg p-3 mb-6">{{ session('success') }}</div>
    @endif

    {{-- Crear token --}}
    <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">Tokens de invitación</h2>
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

    {{-- Pestañas --}}
    <div class="flex gap-2 mb-4">
        <button type="button" id="tab-tokens"
            onclick="cambiarPestana('tokens')"
            class="px-5 py-2.5 text-sm font-medium rounded-lg transition cursor-pointer bg-indigo-600 text-white">
            Tokens ({{ $tokens->count() }})
        </button>
        <button type="button" id="tab-registros"
            onclick="cambiarPestana('registros')"
            class="px-5 py-2.5 text-sm font-medium rounded-lg transition cursor-pointer bg-slate-100 text-slate-600 hover:bg-slate-200">
            Registros ({{ $registrations->count() }})
        </button>
    </div>

    {{-- Tabla de tokens --}}
    @php $filtro = request()->query('filtro'); @endphp
    <div id="panel-tokens">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-4">
                <h2 class="text-lg font-semibold text-slate-800">Tokens</h2>
                <div class="flex gap-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-3 py-1 text-xs rounded-full font-medium transition {{ !$filtro ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        Todos
                    </a>
                    <a href="{{ route('admin.dashboard', ['filtro' => 'disponibles']) }}"
                        class="px-3 py-1 text-xs rounded-full font-medium transition {{ $filtro === 'disponibles' ? 'bg-green-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        Disponibles
                    </a>
                    <a href="{{ route('admin.dashboard', ['filtro' => 'usados']) }}"
                        class="px-3 py-1 text-xs rounded-full font-medium transition {{ $filtro === 'usados' ? 'bg-slate-700 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        Usados
                    </a>
                </div>
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
                                        <div class="flex items-center gap-1">
                                            <input type="text" readonly value="{{ config('app.url') }}/token/{{ $invitationToken->token }}"
                                                id="link-{{ $invitationToken->id }}"
                                                class="text-xs bg-slate-50 border border-slate-200 rounded px-2 py-1 w-64 text-slate-600 select-all">
                                            <button type="button" onclick="copiarEnlace({{ $invitationToken->id }})"
                                                class="p-1.5 rounded hover:bg-slate-100 transition text-slate-400 hover:text-slate-600 cursor-pointer" title="Copiar enlace">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                </svg>
                                            </button>
                                        </div>
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
    </div>

    {{-- Tabla de registros --}}
    <div id="panel-registros" class="hidden">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="text-lg font-semibold text-slate-800">Registros</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">Nombre</th>
                            <th class="px-6 py-3 text-left font-medium">Correo</th>
                            <th class="px-6 py-3 text-left font-medium">¿Qué espera del evento?</th>
                            <th class="px-6 py-3 text-left font-medium">Acompañantes</th>
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
                                <td colspan="5" class="px-6 py-8 text-center text-slate-400">No hay registros aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function cambiarPestana(pestana) {
        var panelTokens = document.getElementById('panel-tokens');
        var panelRegistros = document.getElementById('panel-registros');
        var tabTokens = document.getElementById('tab-tokens');
        var tabRegistros = document.getElementById('tab-registros');

        var activo = 'bg-indigo-600 text-white';
        var inactivo = 'bg-slate-100 text-slate-600 hover:bg-slate-200';

        if (pestana === 'tokens') {
            panelTokens.classList.remove('hidden');
            panelRegistros.classList.add('hidden');
            tabTokens.className = 'px-5 py-2.5 text-sm font-medium rounded-lg transition cursor-pointer ' + activo;
            tabRegistros.className = 'px-5 py-2.5 text-sm font-medium rounded-lg transition cursor-pointer ' + inactivo;
        } else {
            panelTokens.classList.add('hidden');
            panelRegistros.classList.remove('hidden');
            tabTokens.className = 'px-5 py-2.5 text-sm font-medium rounded-lg transition cursor-pointer ' + inactivo;
            tabRegistros.className = 'px-5 py-2.5 text-sm font-medium rounded-lg transition cursor-pointer ' + activo;
        }
    }

    function copiarEnlace(id) {
        var input = document.getElementById('link-' + id);
        navigator.clipboard.writeText(input.value).then(function () {
            var btn = input.nextElementSibling;
            var originalHtml = btn.innerHTML;
            btn.innerHTML = '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            setTimeout(function () { btn.innerHTML = originalHtml; }, 1500);
        });
    }
</script>
@endsection
