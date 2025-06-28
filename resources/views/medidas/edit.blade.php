@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificación de un Medidas</h1>

   <div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/medidas/update" method="post">
        @method('patch')
        @csrf
        <div class="form-group mb-3">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" 
                id="descripcion" value="{{ $medida->descripcion }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="abreviatura">Abreviatura</label>
            <input type="text" name="abreviatura" class="form-control" 
                id="abreviatura" value="{{ $medida->abreviatura }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ $medida->activo ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$medida->activo ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>


        <input type="hidden" name="id" value="{{ $medida->id_medida }}">

        <button class="btn btn-success my-3 px-4">Actualizar</button>
        <a href="/medidas/" class="btn btn-outline-secondary">
            Volver
        </a>
    </form>
</div>

@endsection
