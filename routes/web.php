<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', function () {
    return view('inicio');
});

function getValidationRules($tabla, $id = null)
{
    switch ($tabla) {
        case 'marcas':
            return [
                'nombre' => 'required|string|max:250|unique:marcas,marcas_descripcion' . ($id ? ",$id,id_marcas" : ''),
            ];

        case 'medidas':
            return [
                'descripcion' => 'required|string|max:250|unique:medidas,descripcion' . ($id ? ",$id,id_medida" : ''),
                'abreviatura' => 'required|string|max:250',
                'estado' => 'required|boolean',
            ];

        case 'condicioniva':
            return [
                'descripcion' => 'required|string|max:250|unique:condicion,descripcion' . ($id ? ",$id,id_condicioniva" : ''),
            ];

        case 'provincias':
            return [
                'descripcion' => 'required|string|max:250|unique:provincias,descripcion' . ($id ? ",$id,id_provincia" : ''),
            ];

        case 'proveedores':
            return [
                'razon_social' => 'required|string|max:250',
                'telefono_contacto' => 'required|numeric|digits:10',
                'persona_contacto' => 'required|string|max:250',
                'cuit' => 'required|string|numeric|digits:11|unique:proveedores,cuit' . ($id ? ",$id,id_proveedores" : ''),
                'rela_condicioniva' => 'required|exists:condicion,id_condicioniva',
            ];

        case 'clientes':
            return [
                'nombre' => 'required|string|max:250',
                'apellido' => 'required|string|max:250',
                'dni' => 'required|numeric|digits:8|unique:clientes,dni' . ($id ? ",$id,id_clientes" : ''),
                'fechanacimiento' => 'required|date|before:today',
                'rela_provincia' => 'required|exists:provincias,id_provincia',
                'localidad' => 'required|string|max:250',
                'direccion' => 'required|string|max:250',
                'cuit' => 'required|string|numeric|digits:11|unique:clientes,cuit' . ($id ? ",$id,id_clientes" : ''),
                'email' => 'required|email|max:250|unique:clientes,email' . ($id ? ",$id,id_clientes" : ''),
                'telefono' => 'required|numeric|digits:10',
                'rela_condicioniva' => 'required|exists:condicion,id_condicioniva',
            ];

        case 'productos':
            return [
                'descripcion' => 'required|string|max:30',
                'rela_marcas' => 'required|exists:marcas,id_marcas',
                'rela_medidas' => 'required|exists:medidas,id_medida',
                'rela_rubro' => 'required|integer',
                'cantidad_actual' => 'required|numeric|min:1',
                'precio_venta' => 'required|numeric|min:1',
                'precio_compra' => 'required|numeric|min:1',
                'porcentaje_utilidad' => 'required|numeric|min:0',
                'rela_proveedor' => 'required|exists:proveedores,id_proveedores',
                'cantidad_minima' => 'required|numeric|min:1',
            ];

        default:
            return [];
    }
}

//  ========================== Crud de Marcas ==============================
// Funcion Reutilizable para traer marcas
function getMarcas(){
    $marcas= DB::table('marcas')->select('id_marcas', 'marcas_descripcion')->get();
    return $marcas->isEmpty() ? false : $marcas;
}


Route::get('/marcas', function () {

    //Query Builder
    // $marcas= DB::table('marcas')->select('id_marcas', 'marcas_descripcion')->get();
    $marcas= getMarcas();

    // dd($marcas);
    return view('marcas.index',[ 'marcas'=>$marcas ] );
});


//Form crear 
Route::get('/marcas/create', function () {


    return view('marcas.create');
});


// Insertando Registro
Route::post('/marcas/store', function ()
{
    //capturamos dato enviado por el form
    $nombre = request()->nombre;
    $validator = Validator::make(request()->all(), getValidationRules('marcas'));

    if ($validator->fails()) {
        return redirect('/marcas/create')
            ->withErrors($validator)
            ->withInput();
    }
    //insertar dato en tabla 
    try {
        
                //Query Builder
        DB::table('marcas')
                ->insert(
                    [ 'marcas_descripcion'=>$nombre ]
                );
        return redirect('/marcas')
                ->with([
                    'mensaje'=>'Marca: '.$nombre.' agregada correctamente.',
                    'css'=>'success'
                ]);
    }
    catch ( \Throwable $th ){
        return redirect('/marcas')
            ->with([
                'mensaje'=>'No se pudo insertar el registro: '.$nombre,
                'css'=>'danger'
            ]);
    }
});

// Editar registro
Route::get('/marcas/edit/{id}', function ($id)
{
    //obtenemos el dato de la Area por su id
    // Query Builder
    $marca = DB::table('marcas')
                    ->where('id_marcas', $id)
                    ->first();

    return view('marcas.edit', [ 'marca'=>$marca ]);
});

// Actualizar registro

 Route::patch('/marcas/update', function ()
 {
     //capturamos datos enviados popr el form
    $id = request()->id;
    $descripcion = request()->nombre;

    // Validacion
    $validator = Validator::make(request()->all(), getValidationRules('marcas', $id));
    if ($validator->fails()) {
        return redirect("/marcas/edit/$id")->withErrors($validator)->withInput();
    }

     try {
         DB::table('marcas')
                 ->where( 'id_marcas', $id )
                 ->update(
                     [ 'marcas_descripcion' => $descripcion ]
                 );
         return redirect('/marcas')
                 ->with([
                         'mensaje'=>'Registro: '.$descripcion.' modificado correctamente',
                         'css'=>'success'
                        ]);
     }
     catch ( \Throwable $th ){
         return redirect('/marcas')
             ->with([
                 'mensaje'=>'No se pudo modificar el registro: '.$descripcion,
                 'css'=>'danger'
             ]);
     }
 });


 
// Confirmar eliminar
Route::get('/marcas/delete/{id}', function ($id) {
    $marca = DB::table('marcas')->where('id_marcas', $id)->first();

    return view('marcas.delete', [
        'marca' => $marca
    ]);
});

// Eliminar registro
Route::delete('/marcas/destroy', function () {
    $id = request()->id;
    $nombre = request()->descripcion;

    try {
        DB::table('marcas')->where('id_marcas', $id)->delete();

        return redirect('/marcas')->with([
            'mensaje' => 'Registro "' . $nombre . '" eliminado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/marcas')->with([
            'mensaje' => 'No se pudo eliminar el registro.',
            'css' => 'danger'
        ]);
    }
});

//  ========================== Crud de Medidas ==============================

function getMedidas(){
    $medidas= DB::table('medidas')->select('id_medida', 'descripcion', 'abreviatura', 'activo')->get();
    return $medidas->isEmpty() ? false : $medidas;
}

Route::get('/medidas', function () {

    //Query Builder
    // $all= DB::table('medidas')->select('id_medida', 'descripcion', 'abreviatura', 'activo')->get();
    $medidas = getMedidas();

    // dd($all);
    return view('medidas.index',[ 'medidas'=>$medidas ] );
});

// Form de crear
Route::get('/medidas/create', function () {
    return view('medidas.create');
});

Route::post('/medidas/store', function () {

    $descripcion = request()->descripcion;
    $abreviatura = request()->abreviatura;
    $estado = request()->estado;

    $validator = Validator::make(request()->all(), getValidationRules('medidas'));
    if ($validator->fails()) {
        return redirect('/medidas/create')->withErrors($validator)->withInput();
    }

    try {
        DB::table('medidas')->insert([
            'descripcion' => $descripcion,
            'abreviatura' => $abreviatura,
            'activo' => $estado,
        ]);

        return redirect('/medidas')->with([
            'mensaje' => 'Registro "' . $descripcion . '" agregada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/medidas')->with([
            'mensaje' => 'No se pudo agregar el registro "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});

// Form de editar
Route::get('/medidas/edit/{id}', function ($id) {
    $medida = DB::table('medidas')->where('id_medida', $id)->first();
    return view('medidas.edit', ['medida' => $medida]);
});

// Actualizar medidas
Route::patch('/medidas/update', function () {

    $id = request()->id;
    $descripcion = request()->descripcion;
    $abreviatura = request()->abreviatura;
    $estado = request()->estado;
    // Validaciones
    $validator = Validator::make(request()->all(), getValidationRules('medidas', $id));
    if ($validator->fails()) {
        return redirect("/medidas/edit/$id")->withErrors($validator)->withInput();
    }
    try {
        DB::table('medidas')
            ->where('id_medida', $id)
            ->update([
                'descripcion' => $descripcion,
                'abreviatura' => $abreviatura,
                'activo' => $estado,
            ]);

        return redirect('/medidas')->with([
            'mensaje' => 'Registro "' . $descripcion . '" modificada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/medidas')->with([
            'mensaje' => 'No se pudo modificar el registro "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});

// Form validar eliminacion
Route::get('/medidas/delete/{id}', function ($id) {
    $medida = DB::table('medidas')->where('id_medida', $id)->first();
    return view('medidas.delete', ['medida' => $medida]);
});

// Eliminar registro
Route::delete('/medidas/destroy', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;

    try {
        DB::table('medidas')->where('id_medida', $id)->delete();

        return redirect('/medidas')->with([
            'mensaje' => 'Medida "' . $descripcion . '" eliminada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/medidas')->with([
            'mensaje' => 'No se pudo eliminar la medida "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});


// ===================== CRUD de Condición IVA =====================

// Funcion Reutilizable para traer condicion iva
function getIVA(){
    $condiciones = DB::table('condicion')->get();
    return $condiciones->isEmpty() ? false : $condiciones;
}

// index
Route::get('/condicioniva', function () {
    $condiciones = getIVA();
    return view('condicioniva.index', ['condiciones' => $condiciones]);
});

// Form de crear
Route::get('/condicioniva/create', function () {
    return view('condicioniva.create');
});

// Almacenar condicioniva
Route::post('/condicioniva/store', function () {
    $descripcion = request()->descripcion;

    
    $validator = Validator::make(request()->all(), getValidationRules('condicioniva'));
    if ($validator->fails()) {
        return redirect('/condicioniva/create')->withErrors($validator)->withInput();
    }


    try {
        DB::table('condicion')->insert([
            'descripcion' => $descripcion
        ]);

        return redirect('/condicioniva')->with([
            'mensaje' => 'Condición IVA "' . $descripcion . '" agregada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/condicioniva')->with([
            'mensaje' => 'No se pudo agregar la condición IVA "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});

// formulario edit
Route::get('/condicioniva/edit/{id}', function ($id) {
    $condicion = DB::table('condicion')->where('id_condicioniva', $id)->first();
    return view('condicioniva.edit', ['condicion' => $condicion]);
});

// update
Route::patch('/condicioniva/update', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;

    // Validacion
    $validator = Validator::make(request()->all(), getValidationRules('condicioniva', $id));
    if ($validator->fails()) {
        return redirect("/condicioniva/edit/$id")->withErrors($validator)->withInput();
    }

    try {
        DB::table('condicion')
            ->where('id_condicioniva', $id)
            ->update(['descripcion' => $descripcion]);

        return redirect('/condicioniva')->with([
            'mensaje' => 'Condición IVA "' . $descripcion . '" actualizada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/condicioniva')->with([
            'mensaje' => 'No se pudo actualizar la condición IVA "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});

// validacion delete
Route::get('/condicioniva/delete/{id}', function ($id) {
    $condicion = DB::table('condicion')->where('id_condicioniva', $id)->first();
    return view('condicioniva.delete', ['condicion' => $condicion]);
});

// destroy
Route::delete('/condicioniva/destroy', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;

    try {
        DB::table('condicion')->where('id_condicioniva', $id)->delete();

        return redirect('/condicioniva')->with([
            'mensaje' => 'Condición IVA "' . $descripcion . '" eliminada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/condicioniva')->with([
            'mensaje' => 'No se pudo eliminar la condición IVA "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});



// ========================== CRUD de Provincias ==============================
function getProvincias(){
    $provincias = DB::table('provincias')->get();
    return $provincias->isEmpty() ? false : $provincias;
}
// index
Route::get('/provincias', function () {
    $provincias = getProvincias();
    return view('provincias.index', [ 'provincias' => $provincias ]);
});
// Form de crear
Route::get('/provincias/create', function () {
    return view('provincias.create');
});
// Almacenar 
Route::post('/provincias/store', function () {
    $descripcion = request()->descripcion;

    // Validacion
    $validator = Validator::make(request()->all(), getValidationRules('provincias'));
    if ($validator->fails()) {
        return redirect('/provincias/create')->withErrors($validator)->withInput();
    }

    try {
        DB::table('provincias')->insert([
            'descripcion' => $descripcion
        ]);

        return redirect('/provincias')->with([
            'mensaje' => 'Registro "' . $descripcion . '" agregada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/provincias')->with([
            'mensaje' => 'No se pudo agregar el registro "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});
// formulario edit
Route::get('/provincias/edit/{id}', function ($id) {
    $provincia = DB::table('provincias')->where('id_provincia', $id)->first();
    return view('provincias.edit', [ 'provincia' => $provincia ]);
});
// update
Route::patch('/provincias/update', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;

    $validator = Validator::make(request()->all(), getValidationRules('provincias', $id));
    if ($validator->fails()) {
        return redirect("/provincias/edit/$id")->withErrors($validator)->withInput();
    }

    try {
        DB::table('provincias')
            ->where('id_provincia', $id)
            ->update([ 'descripcion' => $descripcion ]);

        return redirect('/provincias')->with([
            'mensaje' => 'Registro "' . $descripcion . '" modificada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/provincias')->with([
            'mensaje' => 'No se pudo modificar el registro "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});
// validacion delete
Route::get('/provincias/delete/{id}', function ($id) {
    $provincia = DB::table('provincias')->where('id_provincia', $id)->first();
    return view('provincias.delete', [ 'provincia' => $provincia ]);
});
// destroy
Route::delete('/provincias/destroy', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;

    try {
        DB::table('provincias')->where('id_provincia', $id)->delete();

        return redirect('/provincias')->with([
            'mensaje' => 'Provincia "' . $descripcion . '" eliminada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/provincias')->with([
            'mensaje' => 'No se pudo eliminar la provincia "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});


// ========================== CRUD de Proveedores ==============================

function getProveedores(){
    $proveedores = DB::table('proveedores')->get();
    return $proveedores->isEmpty() ? false : $proveedores;
}

// index
Route::get('/proveedores', function () {
    // $proveedores = DB::table('proveedores')->get();
    $proveedores = getProveedores();
    $condiciones = getIVA();
    // Mapeo rápido: id_condicioniva => descripcion
    $condicionesMap = $condiciones ? $condiciones->pluck('descripcion', 'id_condicioniva') : [];
    return view('proveedores.index', [
        'proveedores' => $proveedores,
        'condiciones' => $condicionesMap
    ]);
});

// Formulario para agregar proveedor
Route::get('/proveedores/create', function () {
    $condiciones = getIVA();
    // dd($condiciones);
    return view('proveedores.create', ['condiciones' => $condiciones]);
});

// Guardar proveedor
Route::post('/proveedores/store', function () {
    $razon_social = request()->razon_social;
    $telefono_contacto = request()->telefono_contacto;
    $persona_contacto = request()->persona_contacto;
    $cuit = request()->cuit;
    $rela_condicioniva = request()->rela_condicioniva;

    // Validacion
    $validator = Validator::make(request()->all(), getValidationRules('proveedores'));
    if ($validator->fails()) {
        return redirect('/proveedores/create')->withErrors($validator)->withInput();
    }

    try {
        DB::table('proveedores')->insert([
            'razon_social' => $razon_social,
            'telefono_contacto' => $telefono_contacto,
            'persona_contacto' => $persona_contacto,
            'cuit' => $cuit,
            'rela_condicioniva' => $rela_condicioniva,
        ]);

        return redirect('/proveedores')->with([
            'mensaje' => 'Proveedor "' . $razon_social . '" agregado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/proveedores')->with([
            'mensaje' => 'No se pudo agregar el proveedor "' . $razon_social . '".',
            'css' => 'danger'
        ]);
    }
});

// Formulario de edición
Route::get('/proveedores/edit/{id}', function ($id) {
    $condiciones = getIVA();

    $proveedor = DB::table('proveedores')->where('id_proveedores', $id)->first();
    return view('proveedores.edit', [
        'proveedor' => $proveedor,
        'condiciones' => $condiciones
    ]);
});

// Actualizar 
Route::patch('/proveedores/update', function () {
    $id = request()->id;
    $data = [
        'razon_social' => request()->razon_social,
        'telefono_contacto' => request()->telefono_contacto,
        'persona_contacto' => request()->persona_contacto,
        'cuit' => request()->cuit,
        'rela_condicioniva' => request()->rela_condicioniva,
    ];

    $validator = Validator::make(request()->all(), getValidationRules('proveedores', $id));
    if ($validator->fails()) {
        return redirect("/proveedores/edit/$id")->withErrors($validator)->withInput();
    }

    try {
        DB::table('proveedores')->where('id_proveedores', $id)->update($data);

        return redirect('/proveedores')->with([
            'mensaje' => 'Proveedor "' . $data['razon_social'] . '" modificado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/proveedores')->with([
            'mensaje' => 'No se pudo modificar el proveedor "' . $data['razon_social'] . '".',
            'css' => 'danger'
        ]);
    }
});

// Confirmación de baja
Route::get('/proveedores/delete/{id}', function ($id) {
    $proveedor = DB::table('proveedores')->where('id_proveedores', $id)->first();
    return view('proveedores.delete', ['proveedor' => $proveedor]);
});

// Destroy
Route::delete('/proveedores/destroy', function () {
    $id = request()->id;
    $razon_social = request()->razon_social;

    try {
        DB::table('proveedores')->where('id_proveedores', $id)->delete();

        return redirect('/proveedores')->with([
            'mensaje' => 'Proveedor "' . $razon_social . '" eliminado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/proveedores')->with([
            'mensaje' => 'No se pudo eliminar el proveedor "' . $razon_social . '".',
            'css' => 'danger'
        ]);
    }
});



//  ========================== Crud de Clientes ==============================

//index
Route::get('/clientes', function () {
    $provincias = getProvincias();
    $condiciones = getIVA();
    // Mapeo rápido: id_condicioniva => descripcion
    $condicionesMap = $condiciones ? $condiciones->pluck('descripcion', 'id_condicioniva') : [];
    $provinciasMap = $provincias ? $provincias->pluck('descripcion', 'id_provincia') : [];
    //Query Builder
    $clientes = DB::table('clientes')->select('id_clientes', 'nombre', 'apellido',  'dni', 'fechanacimiento', 'rela_provincia', 'localidad', 'direccion', 'cuit', 'email', 'telefono', 'rela_condicioniva')->get();

    // dd($clientes);
    return view('clientes.index',[ 
        'clientes'=>$clientes, 
        'condicion'=>$condicionesMap,
        'provincia'=>$provinciasMap
        ] );
});


//create
Route::get('/clientes/create', function () {
    $provincias = getProvincias();
    $condiciones = getIVA();
    return view('clientes.create',[ 
        'provincias'=>$provincias, 
        'condiciones'=>$condiciones
        ]);
});


// store
Route::post('/clientes/store', function ()
{
    //capturamos dato enviado por el form
   $nombre = request()->nombre;
    $apellido = request()->apellido;
    $dni = request()->dni;
    $fechanacimiento = request()->fechanacimiento;
    $rela_provincia = request()->rela_provincia;
    $localidad = request()->localidad;
    $direccion = request()->direccion;
    $cuit = request()->cuit;
    $email = request()->email;
    $telefono = request()->telefono;
    $rela_condicioniva = request()->rela_condicioniva;

    $validator = Validator::make(request()->all(), getValidationRules('clientes'));
    if ($validator->fails()) {
        return redirect('/clientes/create')->withErrors($validator)->withInput();
    }

    //insertar dato en tabla 
    try {
        
        //Query Builder
        DB::table('clientes')->insert([
            'nombre' => $nombre,
            'apellido' => request()->apellido,
            'dni' => request()->dni,
            'fechanacimiento' => request()->fechanacimiento,
            'rela_provincia' => request()->rela_provincia,
            'localidad' => request()->localidad,
            'direccion' => request()->direccion,
            'cuit' => request()->cuit,
            'email' => request()->email,
            'telefono' => request()->telefono,
            'rela_condicioniva' => request()->rela_condicioniva,
        ]);

        return redirect('/clientes')
            ->with([
                'mensaje' => 'Cliente: '.$nombre.' agregado correctamente.',
                'css' => 'success'
            ]);

    }
    catch ( \Throwable $th ){
        return redirect('/clientes')
            ->with([
                'mensaje'=>'No se pudo insertar el registro del cliente: '.$nombre,
                'css'=>'danger'
            ]);
    }
});

// edit
Route::get('/clientes/edit/{id}', function ($id) {
    $provincias = getProvincias();
    $condiciones = getIVA();

    // Obtenemos el cliente por su ID usando Query Builder
    $cliente = DB::table('clientes')
                ->where('id_clientes', $id)
                ->first();

    // vista de edición con los datos del cliente
    return view('clientes.edit', [ 
        'cliente' => $cliente,
        'provincias' => $provincias,
        'condiciones' => $condiciones
    ]);
});

//update
Route::patch('/clientes/update', function () {
    // Capturamos datos del formulario
    $id = request()->id;

    $data = [
        'nombre' => request()->nombre,
        'apellido' => request()->apellido,
        'dni' => request()->dni,
        'fechanacimiento' => request()->fechanacimiento,
        'rela_provincia' => request()->rela_provincia,
        'localidad' => request()->localidad,
        'direccion' => request()->direccion,
        'cuit' => request()->cuit,
        'email' => request()->email,
        'telefono' => request()->telefono,
        'rela_condicioniva' => request()->rela_condicioniva
    ];
    $validator = Validator::make(request()->all(), getValidationRules('clientes', $id));
    if ($validator->fails()) {
        return redirect("/clientes/edit/$id")->withErrors($validator)->withInput();
    }
    
    try {
        DB::table('clientes')
            ->where('id_clientes', $id)
            ->update($data);

        return redirect('/clientes')
            ->with([
                'mensaje' => 'Cliente: ' . $data['nombre'] . ' modificado correctamente.',
                'css' => 'success'
            ]);
    } catch (\Throwable $th) {
        return redirect('/clientes')
            ->with([
                'mensaje' => 'No se pudo modificar el cliente: ' . $data['nombre'],
                'css' => 'danger'
            ]);
    }
});


// delete
Route::get('/clientes/delete/{id}', function ($id) {
    // Obtenemos el cliente por su ID
    $cliente = DB::table('clientes')
                ->where('id_clientes', $id)
                ->first();

    // Enviamos el cliente a la vista de confirmación de eliminación
    return view('clientes.delete', [
        'cliente' => $cliente
    ]);
});

// destroy
Route::delete('/clientes/destroy', function () {
    $id = request()->id;
    $nombre = request()->nombre;
    $apellido = request()->apellido;

    try {
        DB::table('clientes')->where('id_clientes', $id)->delete();

        return redirect('/clientes')->with([
            'mensaje' => 'Cliente "' . $nombre . ' ' . $apellido . '" eliminado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/clientes')->with([
            'mensaje' => 'No se pudo eliminar el cliente "' . $nombre . ' ' . $apellido . '".',
            'css' => 'danger'
        ]);
    }
});



// ========================== CRUD de Productos ==============================

// index
Route::get('/productos', function () {
    
    $productos = DB::table('productos')->select(
        'id_productos',
        'descripcion',
        'rela_marcas',
        'rela_medidas',
        'rela_rubro',
        'cantidad_actual',
        'precio_venta',
        'precio_compra',
        'porcentaje_utilidad',
        'rela_proveedor',
        'cantidad_minima'
    )->get();
    // Llamar a las funciones
    $marcas = getMarcas();
    $medidas = getMedidas();
    $proveedores = getProveedores();

    // Mapear a formato clave => valor
    $marcasMap = $marcas ? $marcas->pluck('marcas_descripcion', 'id_marcas') : [];
    $medidasMap = $medidas ? $medidas->pluck('descripcion', 'id_medida') : [];
    $proveedoresMap = $proveedores ? $proveedores->pluck('razon_social', 'id_proveedores') : [];

    return view('productos.index', [
        'productos' => $productos,
        'marcas' => $marcasMap,
        'medidas' => $medidasMap,
        'proveedores' => $proveedoresMap
    ]);
});

// create form
Route::get('/productos/create', function () {
    return view('productos.create', [
        'marcas' => getMarcas(),
        'medidas' => getMedidas(),
        'proveedores' => getProveedores()
    ]);
});

// store
Route::post('/productos/store', function () {
    $descripcion = request()->descripcion;
    $rela_marcas = request()->rela_marcas;
    $rela_medidas = request()->rela_medidas;
    $rela_rubro = request()->rela_rubro;
    $cantidad_actual = request()->cantidad_actual;
    $precio_venta = request()->precio_venta;
    $precio_compra = request()->precio_compra;
    $porcentaje_utilidad = request()->porcentaje_utilidad;
    $rela_proveedor = request()->rela_proveedor;
    $cantidad_minima = request()->cantidad_minima;

    $validator = Validator::make(request()->all(), getValidationRules('productos'));
    if ($validator->fails()) {
        return redirect('/productos/create')->withErrors($validator)->withInput();
    }

    try {
        DB::table('productos')->insert([
            'descripcion' => $descripcion,
            'rela_marcas' => $rela_marcas,
            'rela_medidas' => $rela_medidas,
            'rela_rubro' => $rela_rubro,
            'cantidad_actual' => $cantidad_actual,
            'precio_venta' => $precio_venta,
            'precio_compra' => $precio_compra,
            'porcentaje_utilidad' => $porcentaje_utilidad,
            'rela_proveedor' => $rela_proveedor,
            'cantidad_minima' => $cantidad_minima,
        ]);

        return redirect('/productos')->with([
            'mensaje' => 'Producto: ' . $descripcion . ' agregado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/productos')->with([
            'mensaje' => 'No se pudo insertar el producto: ' . $descripcion,
            'css' => 'danger'
        ]);
    }
});

// edit
Route::get('/productos/edit/{id}', function ($id) {
    $producto = DB::table('productos')->where('id_productos', $id)->first();
    $marcas = getMarcas();
    $medidas = getMedidas();
    $proveedores = getProveedores();

    return view('productos.edit', [
        'producto' => $producto,
        'marcas' => $marcas,
        'medidas' => $medidas,
        'proveedores' => $proveedores
    ]);
});


// update
Route::patch('/productos/update', function () {
    $id = request()->id;

    $descripcion = request()->descripcion;
    $rela_marcas = request()->rela_marcas;
    $rela_medidas = request()->rela_medidas;
    $rela_rubro = request()->rela_rubro;
    $cantidad_actual = request()->cantidad_actual;
    $precio_venta = request()->precio_venta;
    $precio_compra = request()->precio_compra;
    $porcentaje_utilidad = request()->porcentaje_utilidad;
    $rela_proveedor = request()->rela_proveedor;
    $cantidad_minima = request()->cantidad_minima;

    // Validaciones
    $validator = Validator::make(request()->all(), getValidationRules('productos', $id));
    if ($validator->fails()) {
        return redirect("/productos/edit/$id")->withErrors($validator)->withInput();
    }

    try {
        DB::table('productos')->where('id_productos', $id)->update([
            'descripcion' => $descripcion,
            'rela_marcas' => $rela_marcas,
            'rela_medidas' => $rela_medidas,
            'rela_rubro' => $rela_rubro,
            'cantidad_actual' => $cantidad_actual,
            'precio_venta' => $precio_venta,
            'precio_compra' => $precio_compra,
            'porcentaje_utilidad' => $porcentaje_utilidad,
            'rela_proveedor' => $rela_proveedor,
            'cantidad_minima' => $cantidad_minima,
        ]);

        return redirect('/productos')->with([
            'mensaje' => 'Producto: ' . $descripcion . ' modificado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/productos')->with([
            'mensaje' => 'No se pudo modificar el producto: ' . $descripcion,
            'css' => 'danger'
        ]);
    }
});

// Confirmación de eliminación
Route::get('/productos/delete/{id}', function ($id) {
    $producto = DB::table('productos')->where('id_productos', $id)->first();

    return view('productos.delete', ['producto' => $producto]);
});

// Eliminar de la bd
Route::delete('/productos/destroy', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;

    try {
        DB::table('productos')->where('id_productos', $id)->delete();

        return redirect('/productos')->with([
            'mensaje' => 'Producto "' . $descripcion . '" eliminado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/productos')->with([
            'mensaje' => 'No se pudo eliminar el producto "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});