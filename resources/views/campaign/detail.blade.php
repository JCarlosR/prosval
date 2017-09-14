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
                                <a href="/modificar-y-consultar"
                                   class="btn btn-primary waves-effect waves-light btn-info m-b-5"
                                   role="button">Volver</a>
                            </div>

                            <h4 class="header-title m-t-0 m-b-30">Detalles de la campaña "ABC"</h4>

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Vendedor</th>
                                    <th>Teléfono</th>
                                    <th>Mensaje</th>
                                    <th>Tipo</th>
                                    <th>Colonia</th>
                                    <th>Link</th>
                                    <th>Estatus</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>948574256</td>
                                    <td>prosval@gmail.com</td>
                                    <td>Tipo 1</td>
                                    <td>Colonia 1</td>
                                    <td>Link 1</td>
                                    <td>Estatus</td>
                                </tr>

                                <tr>
                                    <td>Tiger Nixon1</td>
                                    <td>948574246</td>
                                    <td>prosval1@gmail.com</td>
                                    <td>Tipo 2</td>
                                    <td>Colonia 2</td>
                                    <td>Link 2</td>
                                    <td>Estatus1</td>
                                    </td>
                                </tr>

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
