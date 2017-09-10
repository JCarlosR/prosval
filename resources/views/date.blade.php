@extends('layouts.app')

@section('content')     
<!-- modal Nuevo -->
<div id="con-nuevo-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Nuevo contacto</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="field-1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Teléfono</label>
                            <input type="text" class="form-control" id="field-2">
                        </div>
                    </div>                        
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Correo</label>
                            <input type="email" class="form-control" id="field-3">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-4" class="control-label">Tipo</label>
                            <input type="text" class="form-control" id="field-4">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Colonia</label>
                            <input type="text" class="form-control" id="field-5">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-6" class="control-label">Estatus</label>
                            <input type="text" class="form-control" id="field-6">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label">Link</label>
                            <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info waves-effect waves-light">Registrar</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<!-- modal Editar -->
<div id="con-editar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Editar contacto</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="field-1" placeholder="Tiger Nixon">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Teléfono</label>
                            <input type="text" class="form-control" id="field-2" placeholder="948574256">
                        </div>
                    </div>                        
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Correo</label>
                            <input type="email" class="form-control" id="field-3" placeholder="prosval@gmail.com">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-4" class="control-label">Tipo</label>
                            <input type="text" class="form-control" id="field-4" placeholder="Tipo">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Colonia</label>
                            <input type="text" class="form-control" id="field-5" placeholder="Colonia">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-6" class="control-label">Estatus</label>
                            <input type="text" class="form-control" id="field-6" placeholder="Estatus">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label">Link</label>
                            <textarea class="form-control autogrow" id="field-7" placeholder="link" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
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

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="dropdown pull-right">
                             <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-nuevo-modal">Nuevo</button>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Datos de contacto</h4>

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Tipo</th>
                                    <th>Colonia</th>
                                    <th>Link</th>
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
                                    <td>Link 1</td>
                                    <td>Estatus</td>
                                    <td>
                                    <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#con-editar-modal"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i class="fa fa-remove"></i> </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tiger Nixon1</td>
                                    <td>948574246</td>
                                    <td>prosval1@gmail.com</td>
                                    <td>Tipo 2</td>
                                    <td>Colonia 2</td>
                                    <td>Link 2</td>
                                    <td>Estatus1</td>
                                    <td>
                                    <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#con-editar-modal"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i class="fa fa-remove"></i> </button>
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
