@extends('layouts.plantilla')
    @section('contenido')

    <h1>Panel de administración de Condicion IVA</h1>
    
@if( session('mensaje') )
    <div class="alert alert-{{ session('css') }}">
        {{ session('mensaje') }}
    </div>
@endif

<div class="row my-3 d-flex justify-content-between">
    <div class="col text-end">
        <a href="/condicioniva/create" class="btn btn-outline-success">
            <i class="bi bi-plus-square"></i>
            Agregar
        </a>
    </div>
</div>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Condición IVA</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($condiciones as $condicion)
            <tr>
                <th>{{ $condicion->id_condicioniva }}</th>
                <td>{{ $condicion->descripcion }}</td>
                <td>
                    <a href="/condicioniva/edit/{{ $condicion->id_condicioniva }}" class="btn btn-outline-primary me-1">
                        <i class="bi bi-pencil-square"></i>
                        Modificar
                    </a>
                    <a href="/condicioniva/delete/{{ $condicion->id_condicioniva }}" class="btn btn-outline-danger me-1">
                        <i class="bi bi-trash"></i>
                        Eliminar
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    
@endsection
