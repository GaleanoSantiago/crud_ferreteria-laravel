@extends('layouts.plantilla')
@section('contenido')

<h1>Modificación de un Cliente</h1>

<div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/clientes/update" method="post">
        @method('patch')
        @csrf

        <div class="form-group">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $cliente->nombre }}" required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" id="apellido" value="{{ $cliente->apellido }}" required>
            </div>

            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="number" name="dni" class="form-control" id="dni" value="{{ $cliente->dni }}" required>
            </div>

            <div class="mb-3">
                <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="fechanacimiento" class="form-control" id="fechanacimiento" value="{{ $cliente->fechanacimiento }}" required>
            </div>

            <div class="mb-3">
                <label for="rela_provincia" class="form-label">Provincia</label>
                <select name="rela_provincia" id="rela_provincia" class="form-select" required>
                    <option value="">Seleccione una provincia</option>
                    @foreach ($provincias as $provincia)
                        <option value="{{ $provincia->id_provincia }}"
                            {{ $cliente->rela_provincia == $provincia->id_provincia ? 'selected' : '' }}>
                            {{ $provincia->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" name="localidad" class="form-control" id="localidad" value="{{ $cliente->localidad }}" required>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" id="direccion" value="{{ $cliente->direccion }}" required>
            </div>

            <div class="mb-3">
                <label for="cuit" class="form-label">CUIT</label>
                <input type="text" name="cuit" class="form-control" id="cuit" value="{{ $cliente->cuit }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $cliente->email }}" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="number" name="telefono" class="form-control" id="telefono" value="{{ $cliente->telefono }}" required>
            </div>

            <div class="mb-3">
                <label for="rela_condicioniva" class="form-label">Condición IVA</label>
                <select name="rela_condicioniva" id="rela_condicioniva" class="form-select" required>
                    <option value="">Seleccione una condición IVA</option>
                    @foreach ($condiciones as $condicion)
                        <option value="{{ $condicion->id_condicioniva }}"
                            {{ $cliente->rela_condicioniva == $condicion->id_condicioniva ? 'selected' : '' }}>
                            {{ $condicion->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <input type="hidden" name="id" value="{{ $cliente->id_clientes }}">

        <button class="btn btn-success my-3 px-4">Actualizar</button>
        <a href="/clientes" class="btn btn-outline-secondary">Volver</a>
    </form>

</div>

@endsection
