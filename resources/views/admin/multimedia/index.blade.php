@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <h1>Crear Usuario</h1>
@stop

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="mb-0">Formulario de Registro</h3>
            </div>
            <div class="card-body">
                <h2 class="text-center">📂 Verificación de PDFs en CSV</h2>

                <form method="POST" action="{{ route('ejecutar-python') }}" class="text-center mt-3">
                    @csrf
                    <button type="submit" class="btn btn-primary">🔍 Comprobar</button>
                </form>
    
                <div class="mt-4">
                    @if (isset($resultado))
                        <div class="alert alert-info">{!! $resultado !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log("Formulario de creación de usuario cargado"); </script>
@stop