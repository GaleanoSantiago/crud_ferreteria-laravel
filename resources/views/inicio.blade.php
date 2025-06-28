@extends('layouts.plantilla')
    @section('contenido')

        <h1>Panel Ferreteria</h1>
        <div class="row container-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Clientes</h5>
                    <div class="d-flex btns-container justify-content-center">
                        <a href="/clientes/" class="btn btn-primary btn-panel">Administrar</a>
                        
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Condición IVA</h5>
                    <div class="d-flex btns-container justify-content-center">
                        <a href="/condicioniva/" class="btn btn-primary btn-panel">Administrar</a>
                        
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Marcas</h5>
                    <div class="d-flex btns-container justify-content-center">
                        <a href="/marcas/" class="btn btn-primary btn-panel">Administrar</a>
                        
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Medidas</h5>
                    <div class="d-flex btns-container justify-content-center">
                        <a href="/medidas/" class="btn btn-primary btn-panel">Administrar</a>
                        
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Productos</h5>
                    <div class="d-flex btns-container justify-content-center">
                        <a href="/productos/" class="btn btn-primary btn-panel">Administrar</a>
                        
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Proveedores</h5>
                    <div class="d-flex btns-container justify-content-center">
                        <a href="/proveedores/" class="btn btn-primary btn-panel">Administrar</a>
                        
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Provincias</h5>
                    <div class="d-flex btns-container justify-content-center">
                        <a href="/provincias/" class="btn btn-primary btn-panel">Administrar</a>
                        
                    </div>
                </div>
            </div>

        </div>
    @endsection
