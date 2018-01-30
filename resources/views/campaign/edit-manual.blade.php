@extends('layouts.app')

@section('page-title', 'Nueva campaña (manual)')

@section('styles')
    <link href="{{ asset('plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css">
    <style>
        .table > tbody > tr > th {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')     
{{-- modal add detail--}}
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
                                <input type="text" placeholder="55 9999 9999" data-mask="55 9999 9999" class="form-control" id="phone" name="phone" required>
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

{{-- modal upload csv --}}
<div id="cargar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Cargar destinatarios desde Excel</h4>
            </div>
            <form action="{{ url('/campaigns/'.$campaign->id.'/upload') }}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <p>
                        Si tienes dudas sobre cómo cargar la información:
                        <a href="/data ejemplo (no usar cabeceras).csv" class="btn btn-primary btn-xs">
                            <i class="fa fa-download"></i> Descargar CSV de ejemplo
                        </a>
                    </p>

                    <input type="file" class="dropify" data-max-file-size="5M" name="csv" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Cargar</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

{{-- modal edit detail--}}
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Editar destinatario</h4>
            </div>
            <form action="{{ url('/campaigns/details') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="detail_id" value="" id="edit_detail_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="schedule_date_2" class="control-label">Fecha de envío</label>
                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="schedule_date_2" name="schedule_date" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="schedule_time_2" class="control-label">Hora de envío</label>
                                <input type="text" class="form-control" id="schedule_time_2" name="schedule_time">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name_2" class="control-label">Nombre</label>
                                <input type="text" class="form-control" id="name_2" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone_2" class="control-label">Teléfono</label>
                                <input type="text" placeholder="55 9999 9999" data-mask="55 9999 9999" class="form-control" id="phone_2" name="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content_2" class="control-label">Mensaje</label>
                        <textarea id="content_2" name="message" class="form-control" maxlength="140" rows="2" placeholder="Máximo 140 caracteres" required minlength="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="property_2" class="control-label">Propiedad</label>
                        <input type="text" class="form-control" name="property" id="property_2" placeholder="Propiedad">
                    </div>
                    <div class="form-group">
                        <label for="link_2" class="control-label">Link</label>
                        <input type="url" class="form-control" name="link" id="link_2" placeholder="URL">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Aplicar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="card-box">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('notification'))
                    <div class="alert alert-success">
                        {{ session('notification') }}
                    </div>
                @endif

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
                        <th>Mensaje</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($campaign->details as $detail)
                        <tr data-detail="{{ $detail->id }}">
                            <td data-detail="date">{{ $detail->schedule_date }}</td>
                            <td data-detail="time">{{ substr($detail->schedule_time, 0, 5) }}</td>
                            <td data-detail="name">{{ $detail->name }}</td>
                            <td data-detail="phone">{{ $detail->phone }}</td>
                            <td data-detail="property">{{ $detail->property ?: '-' }}</td>
                            <td>
                                @if ($detail->link)
                                    <a href="{{ $detail->link }}" data-detail="link" target="_blank" class="btn btn-default btn-sm">
                                        <i class="fa fa-link"></i>
                                    </a>
                                @else
                                    <button class="btn btn-default btn-sm" disabled>
                                        <i class="fa fa-link"></i>
                                    </button>
                                @endif
                            </td>
                            <td data-detail="message">{{ $detail->message }}</td>
                            <td>
                                @if ($detail->status=='Enviado')
                                    <button class="btn btn-default" data-toggle="tooltip" data-placement="top"
                                            title="Este mensaje ya ha sido enviado">
                                        <span class="fa fa-check"></span>
                                    </button>
                                @else
                                    <button href="" class="btn btn-info btn-sm" data-edit>
                                        <span class="fa fa-edit"></span>
                                    </button>
                                    <a href="{{ url('/campaigns/details/'.$detail->id.'/delete') }}"
                                       class="btn btn-danger btn-sm" onclick="return confirm('Seguro que desea eliminar este mensaje?');">
                                        <span class="fa fa-remove"></span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-box">
                <p><strong>Estado actual de la campaña:</strong> {{ $campaign->status }}</p>

                <form action="{{ url('/campaigns/edit/'.$campaign->id.'/status') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <a href="{{ url('campaigns') }}" class="btn waves-effect waves-light btn-default">
                        <i class="fa fa-backward"></i>
                        Volver al listado de campañas
                    </a>
                    @if ($campaign->status == 'Pendiente')
                        <button type="submit" class="btn waves-effect waves-light btn-primary" name="status" value="Programado"
                                data-toggle="tooltip" data-placement="top" title="Programar envío">
                            Activar campaña
                            <span class="fa fa-send m-l-5"></span>
                        </button>
                    @elseif ($campaign->status == 'Programado')
                        <button type="submit" class="btn waves-effect waves-light btn-danger" name="status" value="Pendiente"
                                data-toggle="tooltip" data-placement="top" title="Volver al estado pendiente">
                            Detener campaña
                            <span class="fa fa-stop m-l-5"></span>
                        </button>
                    @endif
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
    <script src="{{ asset('plugins/fileuploads/js/dropify.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>

    <script>
        $(function () {
            $editModal = $('#edit-modal');
            $(document).on('click', '[data-edit]', onClickEditDetail);

            $('#schedule_date, #schedule_date_2').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: "yyyy-mm-dd"
            });
            $('#schedule_time, #schedule_time_2').timepicker({
                showMeridian: false
            });
            $('#content, #content_2').maxlength({
                alwaysShow: true
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Arrastra y suelta un archivo o haz clic aquí',
                    'replace': 'Arrastra y suelta o haz clic para reemplazar',
                    'remove': 'Eliminar',
                    'error': 'Ooops, el archivo adjunto no es válido'
                },
                error: {
                    'fileSize': 'El tamaño del archivo es demasiado grande (máx. @{{ value }})'
                }
            });

            initAutocomplete();
        });

        var $editModal;
        function onClickEditDetail() {
            var $tr = $(this).parents('tr');
            var detail_id = $tr.data('detail');
            var date = $tr.find('[data-detail="date"]').text();
            var time = $tr.find('[data-detail="time"]').text();
            var name = $tr.find('[data-detail="name"]').text();
            var phone = $tr.find('[data-detail="phone"]').text();
            var property = $tr.find('[data-detail="property"]').text();
            var $link = $tr.find('[data-detail="link"]');
            if ($link) {
                var link = $link.attr('href');
            }
            var message = $tr.find('[data-detail="message"]').text();

            // set the values read from the table
            $editModal.find('#edit_detail_id').val(detail_id);
            $editModal.find('#schedule_date_2').val(date);
            $editModal.find('#schedule_time_2').val(time);
            $editModal.find('#name_2').val(name);
            $editModal.find('#phone_2').val(phone);
            $editModal.find('#property_2').val(property);
            $editModal.find('#link_2').val(link);
            $editModal.find('#content_2').val(message);
            $editModal.modal('show');
        }

        function initAutocomplete() {
            var contacts = {!! $contacts !!};
            $("#name").autoComplete({
                source: function(term, suggest) {
                    term = term.toLowerCase();
                    var matches = [];
                    for (var i=0; i<contacts.length; i++)
                        if (~contacts[i].toLowerCase().indexOf(term))
                            matches.push(contacts[i]);
                    suggest(matches);
                },
                onSelect: function(event, term) {
                    // console.log(event);
                    console.log(term);
                    var name = term.substr(0, term.indexOf('(')-1);
                    var phone = term.substr(term.indexOf('(')+1, 12); // 10 digits +2 spaces
                    $('#name').val(name);
                    $('#phone').val(phone);
                }
            });
        }
    </script>
@endsection