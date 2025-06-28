@extends('layouts.plantilla')
@section('contenido')

<h1>Baja de un Registro</h1>

   <div class="alert text-danger bg-light p-4 col-8 mx-auto shadow">
    Se eliminará el cliente:
    <span class="fs-4">{{ $cliente->nombre }} {{ $cliente->apellido }}</span>.
    
    <form action="/clientes/destroy" method="post">
        @method('delete')
        @csrf

        <input type="hidden" name="id" value="{{ $cliente->id_clientes }}">
        <input type="hidden" name="nombre" value="{{ $cliente->nombre }}">
        <input type="hidden" name="apellido" value="{{ $cliente->apellido }}">

        <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
        <a href="/clientes" class="btn btn-outline-secondary btn-block my-2">
            Volver al listado
        </a>
    </form>
</div>


@endsection
