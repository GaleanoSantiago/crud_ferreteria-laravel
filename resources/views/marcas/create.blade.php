@extends('layouts.plantilla')
@section('contenido')

    <h1>Alta de un Marcas</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/marcas/store" method="post" >
        @csrf
            <div class="form-group">
                <label for="nombre">Nombre de Marca</label>
                <input type="text" name="nombre" class="form-control" id="nombre" required>
            </div>

            <button class="btn btn-success my-3 px-4">Guardar</button>
            <a href="/marcas/" class="btn btn-outline-secondary">
                Volver
            </a>
        </form>
    </div>

@endsection