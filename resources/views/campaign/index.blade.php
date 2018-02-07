@extends('layouts.app')

@section('page-title', 'Campañas')

@section('content')     
<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="card-box table-responsive">
                <div class="dropdown pull-right">
                </div>

                <h4 class="header-title m-t-0 m-b-30">Pantalla resumen</h4>

                @if (session('notification'))
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('notification') }}
                    </div>
                @endif

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha creación</th>
                            <th>Nombre campaña</th>
                            <th>Próxima fecha envío</th>
                            <th>Número de envíos</th>
                            <th>Estatus</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td>{{ $campaign->created_at }}</td>
                            <td>{{ $campaign->name }}</td>
                            <td>{{ $campaign->next_schedule_date }}</td>
                            <td>{{ $campaign->details()->where('status', 'Enviado')->count() }} / {{ $campaign->details()->count() }}</td>
                            <td>{{ $campaign->status }}</td>
                            <td>
                                <a href="{{ url('/campaigns/edit/'.$campaign->id) }}" class="btn waves-effect waves-light btn-success" title="Editar programación">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ url('/campaigns/'.$campaign->id.'/details') }}" class="btn btn-primary waves-effect waves-light" title="Ver programación de envíos">
                                    <i class="fa fa-align-justify"></i>
                                </a>
                                <a href="{{ url('/campaigns/'.$campaign->id.'/delete') }}" class="btn btn-danger waves-effect waves-light" title="Eliminar campaña" onclick="return confirm('Seguro que desea eliminar este mensaje?');">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
        2017 © PROSVAL.
    </footer>
</div>
@endsection
