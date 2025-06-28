@extends('layouts.plantilla')
    @section('contenido')
    <h1>Panel de administración de Marcas</h1>

    
    @if( session('mensaje') )
        <div class="alert alert-{{ session('css') }}">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="row my-3 d-flex justify-content-between">
        <!-- <div class="col">
            <a href="/inicio" class="btn btn-outline-secondary">
                Listado
            </a>
        </div> -->
        <div class="col text-end">
            <a href="/marcas/create" class="btn btn-outline-success">
                <i class="bi bi-plus-square"></i>
                Agregar
            </a>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Marcas</th>
                <th scope="col">
                Acciones
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($marcas as $marca)
            <tr>
                <th>{{ $marca->id_marcas }}</th>
                <td>{{ $marca->marcas_descripcion }}</td>
                <td>
                    <a href="/marcas/edit/{{ $marca->id_marcas }}" class="btn btn-outline-primary me-1">
                        <i class="bi bi-pencil-square"></i>
                        Modificar
                    </a>
                    <a href="/marcas/delete/{{ $marca->id_marcas }}" class="btn btn-outline-danger me-1">
                        <i class="bi bi-trash"></i>
                        &nbsp;Eliminar&nbsp;
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
    
@endsection
