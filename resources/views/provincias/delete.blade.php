@extends('layouts.plantilla')
@section('contenido')

    <h1>Baja de un Registro</h1>

    <div class="alert text-danger bg-light p-4 col-8 mx-auto shadow">
    Se eliminará el registro:
    <span class="fs-4">{{ $provincia->descripcion }}</span>.
    <form action="/provincias/destroy" method="post">
        @method('delete')
        @csrf
        <input type="hidden" name="id" value="{{ $provincia->id_provincia }}">
        <input type="hidden" name="descripcion" value="{{ $provincia->descripcion }}">

        <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
        <a href="/provincias" class="btn btn-outline-secondary btn-block my-2">
            Volver al panel
        </a>
    </form>
</div>

@endsection
