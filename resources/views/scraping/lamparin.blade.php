@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">

                @if (session('notification'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('notification') }}
                    </div>
                @endif

                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Lamparín</h4>

                    <p>
                        Lamparían extrae anuncios clasificados de propiedades de 3 sitios web
                        (<code>segundamano.mx</code>, <code>inmuebles24.com</code> y <code>metroscubicos.com</code>),
                        de 2 estados de México: "Ciudad de México" y "Estado de México".
                    </p>
                    <p>
                        Aunque el proceso de extracción ocurre cada 5 minutos, la información está en una base de datos exclusiva de Lamparín.
                        Por tanto es posible generar reportes usando la data ya extraída.
                    </p>

                    <div class="alert alert-info alert-dismissable">
                        Selecciones las opciones para exportar los datos:
                    </div>


                    <form action="" method="post">
                        {{ csrf_field() }}

                        <fieldset>
                            {!! implode('<br>', $html_campos) !!}
                        </fieldset>

                        <button class="btn btn-primary" type="submit">
                            Enviar
                        </button>
                    </form>
                </div>

            </div><!-- container -->
        </div><!-- content -->
    </div>
@endsection
