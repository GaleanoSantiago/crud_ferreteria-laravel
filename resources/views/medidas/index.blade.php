@extends('layouts.plantilla')
    @section('contenido')
    <h1>Panel de administración de Medidas</h1>

    
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
            <a href="/medidas/create" class="btn btn-outline-success">
                <i class="bi bi-plus-square"></i>
                Agregar
            </a>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Medida</th>
                <th scope="col">Abreviatura</th>
                <th scope="col">Activo</th>
                <th scope="col">
                Acciones
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($medidas as $medida)
            <tr>
                <th>{{ $medida->id_medida }}</th>
                <td>{{ $medida->descripcion }}</td>
                <td>{{ $medida->abreviatura }}</td>
                <td>{{ $medida->activo }}</td>
                <td>
                    <a href="/medidas/edit/{{ $medida->id_medida }}" class="btn btn-outline-primary me-1">
                        <i class="bi bi-pencil-square"></i>
                        Modificar
                    </a>
                    <a href="/medidas/delete/{{ $medida->id_medida }}" class="btn btn-outline-danger me-1">
                        <i class="bi bi-trash"></i>
                        &nbsp;Eliminar&nbsp;
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
    
@endsection
