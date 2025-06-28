@extends('layouts.plantilla')
@section('contenido')

    <h1>Alta de un Medidas</h1>

<div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/medidas/store" method="post">
        @csrf
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" id="descripcion" required>
        </div>

        <div class="form-group mt-3">
            <label for="abreviatura">Abreviatura</label>
            <input type="text" name="abreviatura" class="form-control" id="abreviatura" required>
        </div>

        <div class="form-group mt-3">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success my-3 px-4">Guardar</button>
        <a href="/medidas/" class="btn btn-outline-secondary">
            Volver
        </a>
    </form>
</div>


@endsection