@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <h1>Crear Usuario</h1>
@stop

@section('content')
    <div class="container mt-4">
        <h2 class="text-center">📂 Verificar PDF en CSV y Subir </h2>
        {{-- Mostrar mensajes de éxito o error --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <!-- Tarjeta oculta al inicio -->
        <div class="card shadow mt-3">
            <form method="POST" action="{{ route('ejecutar-python') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="card-body">
                        @csrf
                        <button type="submit" class="btn btn-primary">🔍 Comprobar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-4">

        </div>

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{-- <script>
        document.getElementById('archivoCSV').addEventListener('change', function() {
            let tarjeta = document.getElementById('tarjetaVerificacion');

            if (this.files.length > 0) {
                tarjeta.style.display = "block"; // Mostrar tarjeta si se selecciona un archivo
            } else {
                tarjeta.style.display = "none"; // Ocultar si se borra la selección
            }
        });
    </script> --}}
@stop
