@extends('layouts.app')

@section('page-title', 'Nueva campaña (manual)')

@section('content')     
<!-- modal Añadir -->
<div id="añadir-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Añadir destinatario</h4>
            </div>
            <form action="{{ url('/campaigns/'.$campaign->id.'/details') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="schedule_date" class="control-label">Fecha de envío</label>
                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="schedule_date" name="schedule_date" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="schedule_time" class="control-label">Hora de envío</label>
                                <input type="text" class="form-control" id="schedule_time" name="schedule_time">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone" class="control-label">Teléfono</label>
                                <input type="text" placeholder="559 999 9999" data-mask="559 999 9999" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="control-label">Mensaje</label>
                        <textarea id="content" name="message" class="form-control" maxlength="140" rows="2" placeholder="Máximo 140 caracteres" required minlength="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="property" class="control-label">Propiedad</label>
                        <input type="text" class="form-control" name="property" id="property" placeholder="Propiedad">
                    </div>
                    <div class="form-group">
                        <label for="link" class="control-label">Link</label>
                        <input type="url" class="form-control" name="link" id="link" placeholder="URL">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                </div>
            </form>
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

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
        <div class="row">
            <div class="col-sm-12">
               <div class="card-box">
                <div class="form-group">
                    <label for="campaign_name">Nombre campaña</label>
                    <input type="text" placeholder="Escribir nombre de campaña" value="{{ $campaign->name }}" class="form-control" id="campaign_name" disabled>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#añadir-modal">Añadir destinatario</button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#cargar-modal">
                        Cargar destinatarios desde Excel
                    </button>
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
                                    <th>Fecha de envío</th>
                                    <th>Hora de envío</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Propiedad</th>
                                    <th>Link</th>
                                    <th>Opciones</th>
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
                                    <td>
                                        @if ($detail->link)
                                            <a href="{{ $detail->link }}" target="_blank">Ver enlace</a>
                                        @else
                                            Sin enlace
                                        @endif
                                    </td>
                                    <td>
                                        {{--<a href="" class="btn btn-info">--}}
                                            {{--<span class="fa fa-edit"></span>--}}
                                        {{--</a>--}}
                                        <a href="{{ url('/campaigns/details/'.$detail->id.'/delete') }}" class="btn btn-danger">
                                            <span class="fa fa-remove"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>


            <div class="card-box">
                <form action="" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <button type="submit" class="btn waves-effect waves-light btn-primary">
                        Programar envío
                        <span class="fa fa-save m-l-5"></span>
                    </button>
                </form>
            </div>


        </div> <!-- container -->
    </div> <!-- content -->

    <footer class="footer">
        2017 © PROSVAL.
    </footer>

</div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $('#schedule_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "yyyy-mm-dd"
        });
        $('#schedule_time').timepicker({
            showMeridian: false
        });
        $('#content').maxlength({
            alwaysShow: true
        });

        $('.dropify').dropify({
            messages: {
                'default': 'Arrastrar y soltar un archivo o haga clic aquí',
                'replace': 'Arrastre y suelte o haga clic para reemplazar',
                'remove': 'Eliminar',
                'error': 'Ooops, algo mal adjunto.'
            },
            error: {
                'fileSize': 'El tamaño del archivo es demasiado grande (máx. 2M).'
            }
        });
    </script>
@endsection