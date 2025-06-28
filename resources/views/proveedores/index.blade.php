@extends('layouts.plantilla')
    @section('contenido')

    <h1>Panel de administración de Proveedores</h1>

    
@if( session('mensaje') )
    <div class="alert alert-{{ session('css') }}">
        {{ session('mensaje') }}
    </div>
@endif

<div class="row my-3 d-flex justify-content-between">
    <div class="col text-end">
        <a href="/proveedores/create" class="btn btn-outline-success">
            <i class="bi bi-plus-square"></i>
            Agregar
        </a>
    </div>
</div>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Razón Social</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Persona Contacto</th>
            <th scope="col">CUIT</th>
            <th scope="col">Condición IVA</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proveedores as $proveedor)
            <tr>
                <th>{{ $proveedor->id_proveedores }}</th>
                <td>{{ $proveedor->razon_social }}</td>
                <td>{{ $proveedor->telefono_contacto }}</td>
                <td>{{ $proveedor->persona_contacto }}</td>
                <td>{{ $proveedor->cuit }}</td>
                <td>{{ $condiciones[$proveedor->rela_condicioniva] ?? 'Sin definir' }}</td>
                <td>
                    <a href="/proveedores/edit/{{ $proveedor->id_proveedores }}" class="btn btn-outline-primary me-1">
                        <i class="bi bi-pencil-square"></i>
                        Modificar
                    </a>
                    <a href="/proveedores/delete/{{ $proveedor->id_proveedores }}" class="btn btn-outline-danger me-1">
                        <i class="bi bi-trash"></i>
                        Eliminar
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
