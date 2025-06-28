@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificación de un Personal</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/marcas/update" method="post">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre de Marca</label>
                <input type="text" name="descripcion" class="form-control" 
                    id="nombre" value="{{ $marca->marcas_descripcion }}" required>
            </div>
            <input type="hidden" name="id" value="{{ $marca->id_marcas }}">

            <button class="btn btn-success my-3 px-4">Actualizar</button>
            <a href="/marcas/" class="btn btn-outline-secondary">
                Volver
            </a>

        </form>
    </div>

@endsection
