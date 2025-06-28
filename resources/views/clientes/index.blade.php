@extends('layouts.plantilla')
    @section('contenido')
    <h1>Panel de administración de Clientes</h1>

    
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
            <a href="/clientes/create" class="btn btn-outline-success">
                <i class="bi bi-plus-square"></i>
                Agregar
            </a>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">DNI</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Provincia</th>
                <th scope="col">Localidad</th>
                <th scope="col">Dirección</th>
                <th scope="col">CUIT</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Condición IVA</th>             
                <th scope="col">
                Acciones
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id_clientes }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->apellido }}</td>
                <td>{{ $cliente->dni }}</td>
                <td>{{ $cliente->fechanacimiento }}</td>
                <td>{{ $provincia[$cliente->rela_provincia] ?? 'Sin definir' }}</td>
                <td>{{ $cliente->localidad }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->cuit }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $condicion[$cliente->rela_condicioniva] ?? 'Sin definir' }}</td>
                <td>
                    <a href="/clientes/edit/{{ $cliente->id_clientes }}" class="btn btn-outline-primary me-1">
                        <i class="bi bi-pencil-square"></i>
                        Modificar
                    </a>
                    <a href="/clientes/delete/{{ $cliente->id_clientes }}" class="btn btn-outline-danger me-1">
                        <i class="bi bi-trash"></i>
                        &nbsp;Eliminar&nbsp;
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
    
@endsection
