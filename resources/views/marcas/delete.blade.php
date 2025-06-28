@extends('layouts.plantilla')
@section('contenido')

    <h1>Baja de un Registro</h1>

    <div class="alert text-danger bg-light p-4 col-8 mx-auto shadow">
        Se eliminará el registro:
        <span class="fs-4">{{ $marca->marcas_descripcion }}</span>.
        <form action="/marcas/destroy" method="post">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $marca->id_marcas }}">
            <input type="hidden" name="descripcion" value="{{ $marca->marcas_descripcion }}">

            <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
            <a href="/marcas" class="btn btn-outline-secondary btn-block my-2">
                Volver al panel
            </a>
        </form>
    </div>

@endsection
