@extends('adminlte::page')

@section('title', 'Subir Múltiples PDFs')

@section('content_header')
    <h1>Subir Múltiples Archivos PDF</h1>
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

    {{-- Tarjeta para subir múltiples PDFs --}}
    <div class="card">
        <div class="card-body">
            <h4>Subir Múltiples Archivos PDF</h4>
            <form action="{{ route('upload.multiple.pdf') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="pdfs">Seleccionar Archivos PDF</label>
                    <input type="file" name="pdfs[]" class="form-control" multiple accept=".pdf" required>
                    <small class="text-muted">Puedes seleccionar varios archivos a la vez.</small>
                </div>
                <button type="submit" class="btn btn-primary">Subir PDFs</button>
            </form>
        </div>
    </div>

@stop
