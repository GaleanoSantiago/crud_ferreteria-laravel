@extends('layouts.plantilla')
@section('contenido')

    <h1>Alta de un Provincias</h1>

<div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/provincias/store" method="post" >
        @csrf
        <div class="form-group">
            <label for="descripcion">Nombre de Provincia</label>
            <input type="text" name="descripcion" class="form-control" id="descripcion" required>
        </div>

        <button class="btn btn-success my-3 px-4">Guardar</button>
        <a href="/provincias/" class="btn btn-outline-secondary">
            Volver
        </a>
    </form>
</div>

@endsection