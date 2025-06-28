@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificación de un Provincias</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/provincias/update" method="post">
        @method('patch')
        @csrf
        <div class="form-group">
            <label for="descripcion">Nombre de Provincia</label>
            <input type="text" name="descripcion" class="form-control" 
                id="descripcion" value="{{ $provincia->descripcion }}" required>
        </div>
        <input type="hidden" name="id" value="{{ $provincia->id_provincia }}">

        <button class="btn btn-success my-3 px-4">Actualizar</button>
        <a href="/provincias/" class="btn btn-outline-secondary">
            Volver
        </a>
    </form>
</div>

@endsection
