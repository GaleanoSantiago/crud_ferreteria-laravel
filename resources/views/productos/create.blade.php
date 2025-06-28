@extends('layouts.plantilla')
@section('contenido')

    <h1>Alta de un Productos</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/productos/store" method="post">
        @csrf

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" id="descripcion" required>
        </div>

        <div class="mb-3">
            <label for="rela_marcas" class="form-label">Marca</label>
            <select name="rela_marcas" id="rela_marcas" class="form-select" required>
                <option value="">Seleccione una marca</option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id_marcas }}">{{ $marca->marcas_descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rela_medidas" class="form-label">Medida</label>
            <select name="rela_medidas" id="rela_medidas" class="form-select" required>
                <option value="">Seleccione una medida</option>
                @foreach ($medidas as $medida)
                    <option value="{{ $medida->id_medida }}">{{ $medida->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rela_rubro" class="form-label">Rubro</label>
            <select name="rela_rubro" id="rela_rubro" class="form-select" required>
                <option value="">Seleccione un rubro</option>
                <option value="1">Alimentos y Bebidas</option>
                <option value="2">Limpieza</option>
                <option value="3">Ferretería</option>
                <option value="4">Electrónica</option>
                
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_actual" class="form-label">Cantidad Actual</label>
            <input type="number" name="cantidad_actual" class="form-control" id="cantidad_actual" required>
        </div>

        <div class="mb-3">
            <label for="precio_venta" class="form-label">Precio de Venta</label>
            <input type="number" step="0.01" name="precio_venta" class="form-control" id="precio_venta" required>
        </div>

        <div class="mb-3">
            <label for="precio_compra" class="form-label">Precio de Compra</label>
            <input type="number" step="0.01" name="precio_compra" class="form-control" id="precio_compra" required>
        </div>

        <div class="mb-3">
            <label for="porcentaje_utilidad" class="form-label">Porcentaje de Utilidad</label>
            <input type="number" step="0.01" name="porcentaje_utilidad" class="form-control" id="porcentaje_utilidad" required>
        </div>

        <div class="mb-3">
            <label for="rela_proveedor" class="form-label">Proveedor</label>
            <select name="rela_proveedor" id="rela_proveedor" class="form-select" required>
                <option value="">Seleccione un proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedores }}">{{ $proveedor->razon_social }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_minima" class="form-label">Cantidad Mínima</label>
            <input type="number" name="cantidad_minima" class="form-control" id="cantidad_minima" required>
        </div>

        <button class="btn btn-success my-3 px-4">Guardar</button>
        <a href="/productos/" class="btn btn-outline-secondary">Volver</a>
    </form>

</div>


@endsection