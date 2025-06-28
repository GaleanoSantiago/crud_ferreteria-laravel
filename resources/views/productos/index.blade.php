@extends('layouts.plantilla')
    @section('contenido')

    <h1>Panel de administración de Productos</h1>

   @if(session('mensaje'))
    <div class="alert alert-{{ session('css') }}">
        {{ session('mensaje') }}
    </div>
@endif

<div class="row my-3 d-flex justify-content-between">
    <div class="col text-end">
        <a href="/productos/create" class="btn btn-outline-success">
            <i class="bi bi-plus-square"></i>
            Agregar
        </a>
    </div>
</div>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Descripción</th>
            <th scope="col">Marca</th>
            <th scope="col">Medida</th>
            <th scope="col">Rubro</th>
            <th scope="col">Cant. Actual</th>
            <th scope="col">Precio Venta</th>
            <th scope="col">Precio Compra</th>
            <th scope="col">% Utilidad</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Cant. Mínima</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <th>{{ $producto->id_productos }}</th>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $marcas[$producto->rela_marcas] ?? 'Sin marca' }}</td>
                <td>{{ $medidas[$producto->rela_medidas] ?? 'Sin medida' }}</td>
                <td>{{ $producto->rela_rubro }}</td>
                <td>{{ $producto->cantidad_actual }}</td>
                <td>{{ number_format($producto->precio_venta, 2) }}</td>
                <td>{{ number_format($producto->precio_compra, 2) }}</td>
                <td>{{ number_format($producto->porcentaje_utilidad, 2) }}%</td>
                <td>{{ $proveedores[$producto->rela_proveedor] ?? 'Sin proveedor' }}</td>
                <td>{{ $producto->cantidad_minima }}</td>
                <td>
                    <a href="/productos/edit/{{ $producto->id_productos }}" class="btn btn-outline-primary me-1">
                        <i class="bi bi-pencil-square"></i> Modificar
                    </a>
                    <a href="/productos/delete/{{ $producto->id_productos }}" class="btn btn-outline-danger me-1">
                        <i class="bi bi-trash"></i> Eliminar
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    
@endsection
