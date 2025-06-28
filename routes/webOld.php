<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

//  ========================== Crud de Marcas ==============================

//index
Route::get('/marcas', function () {

    //Query Builder
    $marcas= DB::table('marcas')->select('id_marcas', 'marcas_descripcion')->get();


    // dd($marcas);
    return view('marcas.index',[ 'marcas'=>$marcas ] );
});


//create
Route::get('/marcas/create', function () {


    return view('marcas.create');
});


// store
Route::post('/marcas/store', function ()
{
    //capturamos dato enviado por el form
    $nombre = request()->nombre;
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

// edit
Route::get('/marcas/edit/{id}', function ($id)
{
    //obtenemos el dato de la Area por su id
    // Query Builder
    $marca = DB::table('marcas')
                    ->where('id_marcas', $id)
                    ->first();

    return view('marcas.edit', [ 'marca'=>$marca ]);
});

//update
Route::patch('/marcas/update', function ()
{
    //capturamos datos enviados popr el form
    $id = request()->id;
    $descripcion = request()->descripcion;
    
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


 
// delete
Route::get('/marcas/delete/{id}', function ($id) {
    $marca = DB::table('marcas')->where('id_marcas', $id)->first();

    return view('marcas.delete', [
        'marca' => $marca
    ]);
});

// destroy
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

//  ========================== Crud de Clientes ==============================

//index
Route::get('/clientes', function () {

    //Query Builder
    $clientes = DB::table('clientes')->select('id_clientes', 'nombre', 'apellido',  'dni', 'fechanacimiento', 'rela_provincia', 'localidad', 'direccion', 'cuit', 'email', 'telefono', 'rela_condicioniva'
)->get();

    // dd($clientes);
    return view('clientes.index',[ 'clientes'=>$clientes ] );
});


//create
Route::get('/clientes/create', function () {

    return view('clientes.create');
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
    // Obtenemos el cliente por su ID usando Query Builder
    $cliente = DB::table('clientes')
                ->where('id_clientes', $id)
                ->first();

    // Retornamos la vista de edición con los datos del cliente
    return view('clientes.edit', [ 'cliente' => $cliente ]);
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

// ========================== CRUD de Provincias ==============================

// INDEX: Mostrar todas las provincias
Route::get('/provincias', function () {
    $provincias = DB::table('provincias')->get();
    return view('provincias.index', [ 'provincias' => $provincias ]);
});

// CREATE: Formulario para crear una nueva provincia
Route::get('/provincias/create', function () {
    return view('provincias.create');
});

// STORE: Guardar nueva provincia
Route::post('/provincias/store', function () {
    $descripcion = request()->descripcion;

    try {
        DB::table('provincias')->insert([
            'descripcion' => $descripcion
        ]);

        return redirect('/provincias')->with([
            'mensaje' => 'Provincia "' . $descripcion . '" agregada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/provincias')->with([
            'mensaje' => 'No se pudo agregar la provincia "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});

// EDIT: Formulario de edición de una provincia
Route::get('/provincias/edit/{id}', function ($id) {
    $provincia = DB::table('provincias')->where('id_provincia', $id)->first();
    return view('provincias.edit', [ 'provincia' => $provincia ]);
});

// UPDATE: Procesar edición
Route::patch('/provincias/update', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;

    try {
        DB::table('provincias')
            ->where('id_provincia', $id)
            ->update([ 'descripcion' => $descripcion ]);

        return redirect('/provincias')->with([
            'mensaje' => 'Provincia "' . $descripcion . '" modificada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/provincias')->with([
            'mensaje' => 'No se pudo modificar la provincia "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});

// DELETE: Confirmación de eliminación
Route::get('/provincias/delete/{id}', function ($id) {
    $provincia = DB::table('provincias')->where('id_provincia', $id)->first();
    return view('provincias.delete', [ 'provincia' => $provincia ]);
});

// DESTROY: Eliminar definitivamente
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

// ========================== CRUD de Medidas ==============================

// INDEX: Mostrar todas las medidas
Route::get('/medidas', function () {
    $medidas = DB::table('medidas')->get();
    return view('medidas.index', ['medidas' => $medidas]);
});

// CREATE: Formulario para crear una nueva medida
Route::get('/medidas/create', function () {
    return view('medidas.create');
});

// STORE: Guardar nueva medida
Route::post('/medidas/store', function () {
    $descripcion = request()->descripcion;
    $abreviatura = request()->abreviatura;
    $activo = request()->has('activo') ? 1 : 0;

    try {
        DB::table('medidas')->insert([
            'descripcion' => $descripcion,
            'abreviatura' => $abreviatura,
            'activo' => $activo,
        ]);

        return redirect('/medidas')->with([
            'mensaje' => 'Medida "' . $descripcion . '" agregada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/medidas')->with([
            'mensaje' => 'No se pudo agregar la medida "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});

// EDIT: Formulario de edición de una medida
Route::get('/medidas/edit/{id}', function ($id) {
    $medida = DB::table('medidas')->where('id_medida', $id)->first();
    return view('medidas.edit', ['medida' => $medida]);
});

// UPDATE: Procesar edición
Route::patch('/medidas/update', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;
    $abreviatura = request()->abreviatura;
    $activo = request()->has('activo') ? 1 : 0;

    try {
        DB::table('medidas')
            ->where('id_medida', $id)
            ->update([
                'descripcion' => $descripcion,
                'abreviatura' => $abreviatura,
                'activo' => $activo,
            ]);

        return redirect('/medidas')->with([
            'mensaje' => 'Medida "' . $descripcion . '" modificada correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/medidas')->with([
            'mensaje' => 'No se pudo modificar la medida "' . $descripcion . '".',
            'css' => 'danger'
        ]);
    }
});

// DELETE: Confirmación de eliminación
Route::get('/medidas/delete/{id}', function ($id) {
    $medida = DB::table('medidas')->where('id_medida', $id)->first();
    return view('medidas.delete', ['medida' => $medida]);
});

// DESTROY: Eliminar definitivamente
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

// ========================== CRUD de Productos ==============================

// INDEX: Mostrar todos los productos
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

    return view('productos.index', ['productos' => $productos]);
});

// CREATE: Formulario para crear un nuevo producto
Route::get('/productos/create', function () {
    return view('productos.create');
});

// STORE: Guardar nuevo producto
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

// EDIT: Formulario de edición de un producto
Route::get('/productos/edit/{id}', function ($id) {
    $producto = DB::table('productos')->where('id_productos', $id)->first();

    return view('productos.edit', ['producto' => $producto]);
});

// UPDATE: Procesar edición
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

// DELETE: Confirmación de eliminación
Route::get('/productos/delete/{id}', function ($id) {
    $producto = DB::table('productos')->where('id_productos', $id)->first();

    return view('productos.delete', ['producto' => $producto]);
});

// DESTROY: Eliminar definitivamente
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

// ========================== CRUD de Proveedores ==============================

// INDEX: Mostrar todos los proveedores
Route::get('/proveedores', function () {
    $proveedores = DB::table('proveedores')->get();
    return view('proveedores.index', ['proveedores' => $proveedores]);
});

// CREATE: Formulario para agregar proveedor
Route::get('/proveedores/create', function () {
    return view('proveedores.create');
});

// STORE: Guardar nuevo proveedor
Route::post('/proveedores/store', function () {
    $razon_social = request()->razon_social;
    $telefono_contacto = request()->telefono_contacto;
    $persona_contacto = request()->persona_contacto;
    $cuit = request()->cuit;
    $rela_condicioniva = request()->rela_condicioniva;

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

// EDIT: Formulario de edición
Route::get('/proveedores/edit/{id}', function ($id) {
    $proveedor = DB::table('proveedores')->where('id_proveedores', $id)->first();
    return view('proveedores.edit', ['proveedor' => $proveedor]);
});

// UPDATE: Actualizar proveedor
Route::patch('/proveedores/update', function () {
    $id = request()->id;
    $data = [
        'razon_social' => request()->razon_social,
        'telefono_contacto' => request()->telefono_contacto,
        'persona_contacto' => request()->persona_contacto,
        'cuit' => request()->cuit,
        'rela_condicioniva' => request()->rela_condicioniva,
    ];

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

// DELETE: Confirmación de baja
Route::get('/proveedores/delete/{id}', function ($id) {
    $proveedor = DB::table('proveedores')->where('id_proveedores', $id)->first();
    return view('proveedores.delete', ['proveedor' => $proveedor]);
});

// DESTROY: Eliminar definitivamente
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

// ===================== CRUD de Condición IVA =====================

// INDEX: Mostrar todas las condiciones IVA
Route::get('/condicioniva', function () {
    $condiciones = DB::table('condicion')->get();
    return view('condicioniva.index', ['condiciones' => $condiciones]);
});

// CREATE: Formulario para nueva condición IVA
Route::get('/condicioniva/create', function () {
    return view('condicioniva.create');
});

// STORE: Guardar nueva condición
Route::post('/condicioniva/store', function () {
    $descripcion = request()->descripcion;

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

// EDIT: Formulario para editar
Route::get('/condicioniva/edit/{id}', function ($id) {
    $condicion = DB::table('condicion')->where('id_condicioniva', $id)->first();
    return view('condicioniva.edit', ['condicion' => $condicion]);
});

// UPDATE: Procesar edición
Route::patch('/condicioniva/update', function () {
    $id = request()->id;
    $descripcion = request()->descripcion;

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

// DELETE: Confirmación
Route::get('/condicioniva/delete/{id}', function ($id) {
    $condicion = DB::table('condicion')->where('id_condicioniva', $id)->first();
    return view('condicioniva.delete', ['condicion' => $condicion]);
});

// DESTROY: Eliminar
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
