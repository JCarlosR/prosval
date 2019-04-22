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
                    <h4 class="header-title m-t-0 m-b-30">Extracción de datos: Portales inmobiliarios</h4>

                    <p>
                        Lamparían extrae anuncios clasificados de propiedades de 3 sitios web
                        (<code>segundamano.mx</code>, <code>inmuebles24.com</code> y <code>metroscubicos.com</code>),
                        de 2 estados de México: "Ciudad de México" y "Estado de México".
                    </p>
                    <p>
                        El proceso de extracción ocurre cada 5 minutos, y la información está en una base de datos exclusiva de Lamparín (independiente a la BD de Prosval).
                    </p>

                    <div class="alert alert-info alert-dismissable text-dark">
                        A continuación es posible generar reportes a partir de la data ya extraída:
                    </div>


                    <form action="" method="post">
                        {{ csrf_field() }}

                            @foreach ($fields as $field)
                                <div class="form-group col-md-6">
                                    @if ($field->is_select)
                                        <label for="{{ $field->name }}">{{ $field->label }}</label>
                                        <select name="{{ $field->name }}" id="{{ $field->name }}" class="form-control">
                                            <option value="">Seleccione opción</option>
                                            @foreach ($field->options as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>

                                    @elseif ($field->name == 'id')
                                        <label for="{{ $field->name }}">{{ $field->label }} >=</label>
                                        <input type="text" name="{{ $field->name }}" class="form-control" id="{{ $field->name }}">

                                    @elseif ($field->name == 'fecha_anuncio')
                                        <label for="{{ $field->name }}">Fecha de anuncio entre</label>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="text" name="{{ $field->name }}[]" placeholder="Formato: AAAA-MM-DD" class="form-control">
                                            </div>
                                            <div class="col-md-1">
                                                y
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="{{ $field->name }}[]" placeholder="Formato: AAAA-MM-DD" class="form-control">
                                            </div>
                                        </div>
                                    @else
                                        <label for="{{ $field->name }}">{{ $field->label }} =</label>
                                        <input type="text" name="{{ $field->name }}" class="form-control" id="{{ $field->name }}">
                                    @endif
                                </div>
                            @endforeach

                        <button class="btn btn-primary" type="submit">
                            Consultar
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>

            </div><!-- container -->
        </div><!-- content -->
    </div>
@endsection
