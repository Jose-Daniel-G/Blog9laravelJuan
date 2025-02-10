@extends('adminlte::page')

@section('title', 'Subir Archivos')

@section('content_header')
    <h1>Subir Archivos CSV y PDF</h1>
@stop

@section('content')

    {{-- Mostrar mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

    {{-- Tarjeta para subir CSV --}}
    <div class="card">
        <div class="card-body">
            <h4>Subir Archivo CSV</h4>
            <form action="{{ route('csv.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="csv_file">Seleccionar Archivo CSV</label>
                    <input type="file" name="csv_file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Subir CSV</button>
            </form>
        </div>
    </div>

    {{-- Tarjeta para subir PDF --}}
    <div class="card mt-3">
        <div class="card-body">
            <h4>Subir Archivo PDF</h4>
            <form action="{{ route('upload.pdf') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="pdf">Seleccionar Archivo PDF</label>
                    <input type="file" name="pdf" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Subir PDF</button>
            </form>
        </div>
    </div>

@stop
