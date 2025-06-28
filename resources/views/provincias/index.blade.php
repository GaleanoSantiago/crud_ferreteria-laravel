@extends('layouts.plantilla')
    @section('contenido')

    <h1>Panel de administración de Provincias</h1>

    
    @if( session('mensaje') )
    <div class="alert alert-{{ session('css') }}">
        {{ session('mensaje') }}
    </div>
@endif

<div class="row my-3 d-flex justify-content-between">
    <div class="col text-end">
        <a href="/provincias/create" class="btn btn-outline-success">
            <i class="bi bi-plus-square"></i>
            Agregar
        </a>
    </div>
</div>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Provincia</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($provincias as $provincia)
            <tr>
                <th>{{ $provincia->id_provincia }}</th>
                <td>{{ $provincia->descripcion }}</td>
                <td>
                    <a href="/provincias/edit/{{ $provincia->id_provincia }}" class="btn btn-outline-primary me-1">
                        <i class="bi bi-pencil-square"></i>
                        Modificar
                    </a>
                    <a href="/provincias/delete/{{ $provincia->id_provincia }}" class="btn btn-outline-danger me-1">
                        <i class="bi bi-trash"></i>
                        Eliminar
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    
@endsection
