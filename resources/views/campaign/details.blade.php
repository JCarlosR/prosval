@extends('layouts.app')

@section('page-title', 'Detalles de campaña')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">

                <div class="card-box table-responsive">
                    <div class="dropdown pull-right">
                        <a href="/campaigns"
                           class="btn btn-primary waves-effect waves-light btn-info m-b-5"
                           role="button">Volver</a>
                    </div>

                    <h4 class="header-title m-t-0 m-b-30">Detalles de la campaña "{{ $campaign->name }}"</h4>

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Fecha de envío</th>
                            <th>Hora de envío</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Propiedad</th>
                            <th>Mensaje</th>
                            <th>Link</th>
                            <th>Estatus</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($campaign->details as $detail)
                            <tr>
                                <td>{{ $detail->schedule_date }}</td>
                                <td>{{ substr($detail->schedule_time, 0, 5) }}</td>
                                <td>{{ $detail->name }}</td>
                                <td>{{ $detail->phone }}</td>
                                <td>{{ $detail->property ?: '-' }}</td>
                                <td>{{ $detail->message }}</td>
                                <td>
                                    @if ($detail->link)
                                        <a href="{{ $detail->link }}" target="_blank" class="btn btn-default btn-sm">
                                            <i class="fa fa-link"></i>
                                        </a>
                                    @else
                                        <button class="btn btn-default btn-sm" disabled>
                                            <i class="fa fa-link"></i>
                                        </button>
                                    @endif
                                </td>
                                <td>{{ $detail->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <footer class="footer">
            2017 - 2018 © PROSVAL.
        </footer>
    </div>
@endsection
