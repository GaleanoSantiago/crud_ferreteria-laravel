@extends('layouts.plantilla')
@section('contenido')

    <h1>Alta de un Condicion IVA</h1>

<div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/condicioniva/store" method="post">
        @csrf
        <div class="form-group">
            <label for="descripcion">Descripción de la Condición IVA</label>
            <input type="text" name="descripcion" class="form-control" id="descripcion" required>
        </div>

        <button class="btn btn-success my-3 px-4">Guardar</button>
        <a href="/condicioniva" class="btn btn-outline-secondary">
            Volver
        </a>
    </form>
</div>

@endsection