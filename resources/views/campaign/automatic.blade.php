@extends('layouts.app')

@section('page-title', 'Nueva campaña (automático)')

@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-20">
                                    <div class="form-group">
                                        <label>Nombre de campaña</label>
                                        <input type="text" name="titulo" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Mensaje</label>
                                        <textarea id="textarea" name="mensaje" class="form-control" maxlength="140" rows="2" placeholder="Máximo de 140 caracteres..."></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="input-daterange input-group" id="date-range"> <!-- trabajaras con ese id papu-->
                                            <div class="col-md-6">
                                                <form role="form">
                                                    <div class="form-group">
                                                        <label class="control-label" for="precio1_min">Fecha inicio</label>
                                                        <div class="input-group m-t-10">
                                                            <span class="input-group-addon"><i class="ti-calendar"></i></span>
                                                            <input type="text" class="form-control" name="start" />
                                                        </div>
                                                    </div> <!-- form-group -->
                                                </form>
                                            </div><!-- end col -->
                                            <div class="col-md-6">
                                                <form role="form">
                                                    <div class="form-group">
                                                        <label class="control-label" for="precio1_max">Fecha fin</label>
                                                        <div class="input-group m-t-10">
                                                            <span class="input-group-addon"><i class="ti-calendar"></i></span>
                                                            <input type="text" class="form-control" name="end" />
                                                        </div>
                                                    </div> <!-- form-group -->
                                                </form>
                                            </div><!-- end col -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Repetir</label>
                                        <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>Sí</option>
                                                <option>No</option>
                                            </select>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-lg-6">
                                <div class="p-20">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>Frecuencia del envío</label>
                                            <select class="form-control">
                                                    <option>Seleccionar</option>
                                                    <option>Diaria</option>
                                                    <option>Semanal</option>
                                                    <option>Quincenal</option>
                                                    <option>Mensual</option>
                                                    <option>Anual</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Día del envío</label>
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
                                    <div class="row">
                                        <div class="form-group">
                                        <div class="input-daterange input-group" id="date-range"> <!-- trabajaras con ese id papu-->
                                            <div class="col-md-15">
                                                <label class="control-label" for="precio1_min">Hora</label>
                                                <div class="input-group m-b-15">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                    <div class="bootstrap-timepicker">
                                                    <input id="timepicker2" type="text" class="form-control"> 
                                                    </div>
                                                </div><!-- input-group -->
                                            </div><!-- end col -->
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label>Enviar sin nombre</label>
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>Sí</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Enviar teléfono duplicado</label>
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>Sí</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                            </div><!-- end col -->
                        </div><!-- end row -->

                </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-6">       
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>
                        <h4 class="header-title m-t-0 m-b-30">Aviso</h4>
                        <p class="text-muted m-b-15 font-16">
                            Seleccione <code>los avisos</code> que desea para enviar la campaña de SMS  
                        </p>
                        <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]" data-plugin="multiselect">
                            <option>Aviso1</option>
                            <option>Aviso2</option>
                            <option selected>Aviso3</option>
                        </select>
                        </div>
                        <div class="card-box">

                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>
                        <h4 class="header-title m-t-0 m-b-30">Tipo</h4>
                        <p class="text-muted m-b-15 font-16">
                            Seleccione <code>los tipos</code> que desea para enviar la campaña de SMS  
                        </p>
                        <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]" data-plugin="multiselect">
                            <option>tipo1</option>
                            <option>tipo2</option>
                            <option selected>tipo3</option>
                        </select>
                        </div>
                        <div class="card-box">

                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>
                        <h4 class="header-title m-t-0 m-b-30">Categoria</h4>
                        <p class="text-muted m-b-15 font-16">
                            Seleccione <code>las categorias</code> que desea para enviar la campaña de SMS  
                        </p>
                        <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]" data-plugin="multiselect">
                            <option>Categoria1</option>
                            <option>Categoria2</option>
                            <option selected>Categoria3</option>
                        </select>
                    </div>
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Imagen</h4>
                        <div class="form-group">
                            <label>Seleccione una opción</label>
                            <select class="form-control">
                                    <option>Seleccionar</option>
                                    <option>Solo con imagen</option>
                                    <option>Solo sin imagen</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">       
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Título</h4>
                        <p class="text-muted m-b-20 font-16">
                            Excluir palabras
                        </p>
                        <select multiple data-role="tagsinput" placeholder="agregar etiquetas">
                            <option value="Amsterdam"></option>
                            <option value="Washington"></option>
                            <option value="Sydney"></option>
                        </select>
                    </div>
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Descripción</h4>
                        <p class="text-muted m-b-20 font-16">
                            Excluir palabras
                        </p>
                        <select multiple data-role="tagsinput" placeholder="agregar etiquetas">
                            <option value="Amsterdam"></option>
                            <option value="Washington"></option>
                            <option value="Sydney"></option>
                        </select>
                    </div>
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Vendedor</h4>
                        <p class="text-muted m-b-20 font-16">
                            Excluir palabras
                        </p>
                        <select multiple data-role="tagsinput" placeholder="agregar etiquetas">
                            <option value="Vendedor1">Vendedor1</option>
                            <option value="Vendedor2">Vendedor2</option>
                            <option value="Vendedor3">Vendedor3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>
                        <h4 class="header-title m-t-0 m-b-30">Región, municipio, colonia</h4>
                        <div class="sidebar-inner slimscrollleft">
                            <ul class="tree">
                                <li class="has">
                                    <input type="checkbox" name="domain[]" value="region1">
                                    <label>Ciudad de México <span class="total">(2)</span></label>
                                    <ul>
                                        <li class="has">
                                        <input type="checkbox" name="subdomain[]" value="municipio1">
                                        <label>Álvaro Obregón <span class="total">(2)</span></label>
                                        <ul>
                                          <li>
                                            <input type="checkbox" name="subject[]" value="Colonia1">
                                            <label>San Angel</label>
                                          </li>
                                          <li>
                                            <input type="checkbox" name="subject[]" value="Colonia2">
                                            <label>Los Alpes</label>
                                          </li>
                                        </ul>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="has">
                                        <input type="checkbox" name="subdomain[]" value="Municipio1">
                                        <label>Azcapotzalco <span class="total">(2)</span></label>
                                        <ul>
                                          <li>
                                            <input type="checkbox" name="subject[]" value="Colonia1">
                                            <label>Palestina</label>
                                          </li>
                                          <li>
                                            <input type="checkbox" name="subject[]" value="Colonia2">
                                            <label>Del Recreo</label>
                                          </li>
                                        </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has">
                                    <input type="checkbox" name="domain[]" value="region2">
                                    <label>Estado de México <span class="total">(2)</span></label>
                                    <ul> 
                                        <li class="has">
                                            <input type="checkbox" name="subdomain[]" value="municipio2">
                                            <label>Jiquipilco <span class="total">(1)</span></label>
                                            <ul>
                                              <li>
                                                <input type="checkbox" name="subject[]" value="Colonia2">
                                                <label>Las Palomitas (Puerto Jiquipilli)</label>
                                              </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end col -->  
                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Moneda 1</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Tipo de moneda</label>
                                        <div class="col-sm-4">
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>Dolar</option>
                                                <option>Soles</option>
                                                <option>Pesos</option>
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                </form>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <form role="form">
                                    <div class="form-group">
                                        <label class="control-label" for="precio1_min">Rango mínimo</label>
                                        <div class="input-group m-t-10">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="number" id="precio1_min" name="precio1_min" class="form-control" placeholder="..">
                                        </div>
                                    </div> <!-- form-group -->
                                </form>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <form role="form">
                                    <div class="form-group">
                                        <label class="control-label" for="precio1_max">Rango máximo</label>
                                        <div class="input-group m-t-10">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="number" id="precio1_max" name="precio1_max" class="form-control" placeholder="..">
                                        </div>
                                    </div> <!-- form-group -->
                                </form>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
                <div class="col-sm-6">
                    <div class="card-box">
                        <div class="dropdown pull-right">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Moneda 2</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Tipo de moneda</label>
                                        <div class="col-sm-4">
                                            <select class="form-control">
                                                <option>Seleccionar</option>
                                                <option>Dolar</option>
                                                <option>Soles</option>
                                                <option>Pesos</option>
                                            </select>
                                        </div>
                                    </div> <!-- form-group -->
                                </form>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <form role="form">
                                    <div class="form-group">
                                        <label class="control-label" for="precio2_min">Rango mínimo</label>
                                        <div class="input-group m-t-10">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="number" id="precio2_min" name="precio2_min" class="form-control" placeholder="..">
                                        </div>
                                    </div> <!-- form-group -->
                                </form>
                            </div><!-- end col -->
                            <div class="col-md-6">
                                <form role="form">
                                    <div class="form-group">
                                        <label class="control-label" for="precio2_max">Rango máximo</label>
                                        <div class="input-group m-t-10">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="number" id="precio2_max" name="precio2_max" class="form-control" placeholder="..">
                                        </div>
                                    </div> <!-- form-group -->
                                </form>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div><!-- end col -->
                             
            </div>
                        <!-- end row -->
            <div class="col-md-12">
                    <div class="card-box">
                        <button type="button" class="btn waves-effect waves-light btn-primary">Guardar</button>
                        <button type="button" class="btn btn-success waves-effect waves-light">Programar</button>
                    </div>
                </div><!-- end col -->  
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
