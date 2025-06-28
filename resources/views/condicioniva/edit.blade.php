@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificación de un Condicion IVA</h1>

<div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/condicioniva/update" method="post">
        @method('patch')
        @csrf
        <div class="form-group">
            <label for="descripcion">Descripción de Condición IVA</label>
            <input type="text" name="descripcion" class="form-control" 
                id="descripcion" value="{{ $condicion->descripcion }}" required>
        </div>
        <input type="hidden" name="id" value="{{ $condicion->id_condicioniva }}">

        <button class="btn btn-success my-3 px-4">Actualizar</button>
        <a href="/condicioniva" class="btn btn-outline-secondary">
            Volver
        </a>
    </form>
</div>

@endsection
