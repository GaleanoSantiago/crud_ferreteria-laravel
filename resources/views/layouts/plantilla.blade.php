@include( 'layouts.header' )
@include( 'layouts.nav' )

    <main class="container py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ocurrieron los siguientes errores:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       @yield('contenido')
    </main>
    
   

@include( 'layouts.footer' )