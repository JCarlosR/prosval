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
                            <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono" class="control-label">Teléfono</label>
                            <input type="text" placeholder="" data-mask="(999)999 999 999" class="form-control" id="telefono" name="telefono">
                            <span class="font-13 text-muted">(094)948 547 848</span>
                        </div>
                    </div>                        

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info waves-effect waves-light">Registrar</button>
            </div>
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
                            <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Tiger Nixon">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono" class="control-label">Teléfono</label>
                            <input type="text" placeholder="(094)948 547 848" data-mask="(999)999 999 999" class="form-control" id="telefono" name="telefono">
                            <span class="font-13 text-muted">(094)948 547 848</span>
                        </div>
                    </div>                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info waves-effect waves-light">Guardar</button>
            </div>
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

                        <h4 class="header-title m-t-0 m-b-30">Lista de SPAM</h4>

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Detalle</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>948574256</td>
                                    <td>
                                    <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#con-editar-modal"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i class="fa fa-remove"></i> </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Tiger Nixon1</td>
                                    <td>948574246</td>
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
