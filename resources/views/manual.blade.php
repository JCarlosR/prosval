@extends('layouts.app')

@section('content')     

<!-- modal Añadir -->
<div id="añadir-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Añadir destinatario</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="datepicker" class="control-label">Fecha Envío</label>
                            <input type="text" class="form-control" placeholder="11/11/2017" id="datepicker" name="datepicker">
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nombre" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tiger Nixon">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono" class="control-label">Teléfono</label>
                            <input type="text" placeholder="" data-mask="(999)999 999 999" class="form-control" id="telefono" name="telefono">
                            <span class="font-13 text-muted">(094)948 547 848</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mensaje" class="control-label">Mensaje</label>
                            <textarea id="mensaje" name="mensaje" class="form-control" maxlength="140" rows="2" placeholder="Máximo 140 caracteres..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="propiedad" class="control-label">Propiedad</label>
                            <input type="text" class="form-control" name="propiedad" id="propiedad" placeholder="Propiedad">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="link" class="control-label">Link</label>
                            <input type="url" required parsley-type="url" class="form-control" name="link" id="link" placeholder="URL">
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

<!-- modal cargar -->
<div id="cargar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Cargar destinatario desde Excel</h4>
            </div>
            <div class="modal-body">
                <input type="file" class="dropify" data-max-file-size="2M" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info waves-effect waves-light">Cargar</button>
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
               <div class="card-box">
                <div class="form-group">
                    <label for="userName">Nombre campaña</label>
                    <input type="text" name="nombre_campaña" parsley-trigger="change" required
                           placeholder="Escribir nombre de campaña" class="form-control" id="nombre_campaña">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#añadir-modal">Añadir destinatario</button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#cargar-modal">Cargar destinatarios desde Excel</button>
                </div>
               </div> 
            </div>
            
        </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha campaña</th>
                                    <th>Nombre campaña</th>
                                    <th>Fecha envío campaña</th>
                                    <th>Hora envío campaña</th>
                                    <th>Número de envíos</th>
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
                                    <td>Estatus</td>
                                </tr>

                                <tr>
                                    <td>Tiger Nixon1</td>
                                    <td>948574246</td>
                                    <td>prosval1@gmail.com</td>
                                    <td>Tipo 2</td>
                                    <td>Colonia 2</td>
                                    <td>Estatus1</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <button type="button" class="btn waves-effect waves-light btn-primary">Guardar y programar envío</button>
                    </div>
                </div><!-- end col -->
            </div>

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
