@extends('layouts.app')

@section('page-title', 'Detalles de campaña')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div class="dropdown pull-right">
                                <a href="/campaigns"
                                   class="btn btn-primary waves-effect waves-light btn-info m-b-5"
                                   role="button">Volver</a>
                            </div>

                            <h4 class="header-title m-t-0 m-b-30">Detalles de la campaña "{{ $campaign->name }}"</h4>

                            <table id="datatable" class="table table-striped table-bordered">
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
                                                <a href="{{ $detail->link }}" target="_blank">Ver enlace</a>
                                            @else
                                                Sin enlace
                                            @endif
                                        </td>
                                        <td>{{ $detail->status }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer">
            2017 © PROSVAL.
        </footer>

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

@endsection
