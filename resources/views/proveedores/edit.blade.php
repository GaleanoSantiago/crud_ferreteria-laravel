@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificación de un Proveedores</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
    <form action="/proveedores/update" method="post">
        @method('patch')
        @csrf

        <div class="form-group mb-2">
            <label for="razon_social">Razón Social</label>
            <input type="text" name="razon_social" class="form-control" 
                id="razon_social" value="{{ $proveedor->razon_social }}" required>
        </div>

        <div class="form-group mb-2">
            <label for="telefono_contacto">Teléfono</label>
            <input type="text" name="telefono_contacto" class="form-control" 
                id="telefono_contacto" value="{{ $proveedor->telefono_contacto }}" required>
        </div>

        <div class="form-group mb-2">
            <label for="persona_contacto">Persona de Contacto</label>
            <input type="text" name="persona_contacto" class="form-control" 
                id="persona_contacto" value="{{ $proveedor->persona_contacto }}" required>
        </div>

        <div class="form-group mb-2">
            <label for="cuit">CUIT</label>
            <input type="text" name="cuit" class="form-control" 
                id="cuit" value="{{ $proveedor->cuit }}" required>
        </div>

        <div class="form-group mb-2">
            <label for="rela_condicioniva">Condición IVA</label>
            <select name="rela_condicioniva" id="rela_condicioniva" class="form-select" required>
                <option value="">Seleccione una condición IVA</option>
                @foreach ($condiciones as $condicion)
                    <option value="{{ $condicion->id_condicioniva }}" {{ $proveedor->rela_condicioniva == $condicion->id_condicioniva ? 'selected' : '' }}>
                        {{ $condicion->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>


        <input type="hidden" name="id" value="{{ $proveedor->id_proveedores }}">

        <button class="btn btn-success my-3 px-4">Actualizar</button>
        <a href="/proveedores" class="btn btn-outline-secondary">
            Volver
        </a>
    </form>
</div>

@endsection
