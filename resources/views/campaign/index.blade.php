@extends('layouts.app')

@section('page-title', 'Campañas')

@section('content')     
<!-- modal Editar -->
<div id="con-editar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Editar campaña</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="datepicker" class="control-label">Fecha campaña</label>
                            <input type="text" class="form-control" placeholder="11/11/2017" id="datepicker" name="datepicker">
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="titulo" class="control-label">Nombre campaña</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Tiger Nixon">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="datepicker-autoclose" class="control-label">Fecha envío campaña</label>
                            <input type="text" class="form-control" placeholder="11/11/2017" id="datepicker-autoclose" name="datepicker-autoclose">
                        </div>
                    </div>                        
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="timepicker2" class="control-label">Hora envío campaña</label>
                                <div class="bootstrap-timepicker">
                                    <input id="timepicker2" name="timepicker2" type="text" class="form-control">
                                </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="numero_envio" class="control-label">Número de envíos</label>
                            <input type="text" class="form-control" id="numero_envio" name="numero_envio" placeholder="11">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="estatus" class="control-label">Estatus</label>
                            <input type="text" class="form-control" id="estatus" name="estatus" placeholder="Good">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info waves-effect waves-light">Guardar</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="dropdown pull-right">
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Pantalla resumen</h4>

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha campaña</th>
                                    <th>Nombre campaña</th>
                                    <th>Fecha envío campaña</th>
                                    <th>Hora envío campaña</th>
                                    <th>Número de envíos</th>
                                    <th>Estatus</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>948574256</td>
                                    <td>prosval@gmail.com</td>
                                    <td>Tipo 1</td>
                                    <td>Colonia 1</td>
                                    <td>Estatus</td>
                                    <td>
                                    <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#con-editar-modal"><i class="fa fa-edit"></i></button>
                                    <a href="/detalle" class="btn btn-primary waves-effect waves-light btn-info m-b-5" role="button"><i class="fa fa-align-justify"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tiger Nixon1</td>
                                    <td>948574246</td>
                                    <td>prosval1@gmail.com</td>
                                    <td>Tipo 2</td>
                                    <td>Colonia 2</td>
                                    <td>Estatus1</td>
                                    <td>
                                    <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#con-editar-modal"><i class="fa fa-edit"></i></button>
                                    <a href="/detalle" class="btn btn-primary waves-effect waves-light btn-info m-b-5" role="button"><i class="fa fa-align-justify"></i></a>
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
<!-- End Right content here -->
@endsection
