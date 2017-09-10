@extends('layouts.app')

@section('content')
         
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

                        <h4 class="header-title m-t-0 m-b-30">Nueva Campaña</h4>

                        <div class="row">
                            <div class="col-lg-6">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nombre</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="example-email">Mensaje</label>
                                        <div class="col-md-10">
                                            <textarea id="textarea" class="form-control" maxlength="140" rows="2" placeholder="Máximo de 140 caracteres..."></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <label class="control-label col-sm-4">Rango de extracción</label>
                                    </div>
                                    <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="input-daterange input-group" id="date-range">
                                                    
                                                    <span class="input-group-addon bg-primary b-0 text-white">Fecha Inicio</span>
                                                    <input type="text" class="form-control" name="start" />
                                                   <span class="input-group-addon bg-primary b-0 text-white">Fecha Fin</span>
                                                    <input type="text" class="form-control" name="end" />
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Repetir</label>
                                        <div class="col-sm-4">
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>SI</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-box">
                                        <h5><b>Filtros de Envío</b></h5>
                                        <p class="text-muted m-b-15 font-13">
                                            seleccionar los criterios de filtrado a donde se desea enviar la campaña 
                                        </p>

                                        <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]" data-plugin="multiselect">
                                            <option>aviso</option>
                                            <option>tipo</option>
                                            <option selected>categoria</option>
                                            <option selected>titulo</option>
                                            <option>descripcion</option>
                                            <option>habitaciones</option>
                                            <option>superficie</option>
                                            <option>moneda1</option>
                                            <option selected>precio1</option>
                                            <option>moneda2</option>
                                            <option>precio2</option>
                                            <option>region</option>
                                            <option>municipio</option>
                                            <option>colonia</option>
                                            <option>codigo_postal</option>
                                            <option>imagen</option>
                                        </select>
                                    </div>
                                </form>
                            </div><!-- end col -->

                            <div class="col-lg-6">
                                <form class="form-horizontal" role="form">
            
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Frecuencia de Envío</label>
                                        <div class="col-sm-8">
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>Diaria</option>
                                                <option>Semanal</option>
                                                <option>Quincenal</option>
                                                <option>Mensual</option>
                                                <option>Anual</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Día del Envío</label>
                                        <div class="col-sm-8">
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>Lunes</option>
                                                <option>Martes</option>
                                                <option>Miércoles</option>
                                                <option>Jueves</option>
                                                <option>Viernes</option>
                                                <option>Sábado</option>
                                                <option>Domingo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="col-sm-4 control-label">Hora (Formato 24H)</label>
                                    <div class="col-sm-4">
                                        <div class="bootstrap-timepicker">
                                            <input id="timepicker2" type="text" class="form-control">
                                        </div>
                                    </div><!-- input-group -->
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-2 control-label">Excluir palabras</label>
                                    
                                    <div class="col-sm-10">
                                        <select multiple data-role="tagsinput">
                                            <option value="Amsterdam">aviso</option>
                                            <option value="Washington">tipo</option>
                                            <option value="Sydney">titulo</option>
                                        </select>
                                    </div>
                                   </div>
                                   <div class="card-box">
                                    <div class="col-md-6">
                                       <div class="p-20">
                                           <form action="#">
                                              <div class="form-group">
                                                <label>Rango mínimo</label>
                                                <input type="text" placeholder="" data-mask="$ 999,999.99" class="form-control">
                                                <span class="font-4 text-muted">$ 999,999.99</span>
                                               
                                              </div>
                                           </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="p-20">
                                           <form action="#">
                                              <div class="form-group">
                                                <label>Rango máximo</label>
                                                <input type="text" placeholder="" data-mask="$ 999,999.99" class="form-control">
                                                <span class="font-4 text-muted">$ 999,999.99</span>
                                               
                                              </div>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-2 control-label">Enviar sin nombre</label>
                                        <div class="col-sm-4">
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>SI</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">enviar teléfono duplicado</label>
                                        <div class="col-sm-4">
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>SI</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>

                                </form>
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <button type="button" class="btn waves-effect waves-light btn-primary">Guardar</button>
                        <button type="button" class="btn btn-success waves-effect waves-light">Programar</button>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer">
        2016 - 2017 © Adminto.
    </footer>

</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
@endsection
