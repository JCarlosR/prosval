@extends('layouts.app')

@section('page-title', 'Contactos marcados como spam')

@section('content')
<div id="modalEditContact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Editar contacto</h4>
            </div>
            <form action="/contact/spam" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="contact_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Teléfono</label>
                                <input type="text" placeholder="559 999 9999" data-mask="559 999 9999" class="form-control" id="telefono" name="phone">
                                <span class="font-13 text-muted">Ejemplo: 558 547 8484</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                </div>
            </form>
    </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">

                        <h4 class="header-title m-t-0 m-b-30">Lista de SPAM</h4>

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td data-name>{{ $contact->name }}</td>
                                    <td data-phone>{{ $contact->phone }}</td>
                                    <td>
                                        <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-edit="{{ $contact->id }}" title="Editar contacto">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="{{ url('/contact/'.$contact->id.'/recover') }}" class="btn btn-icon waves-effect waves-light btn-info m-b-5" title="Recuperar contacto">
                                            <i class="fa fa-rocket"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div><!-- end col -->
            </div>
        </div>
    </div>

    <footer class="footer">
        2017 © PROSVAL.
    </footer>
</div>
@endsection

@section('scripts')
    <script>
        var $modalEditContact;
        (function () {
            $modalEditContact = $('#modalEditContact');

            $('[data-edit]').on('click', onClickEdit);
            function onClickEdit() {
                var id = $(this).data('edit');
                var $tr = $(this).parents('tr');
                var name = $tr.find('[data-name]').text();
                var phone = $tr.find('[data-phone]').text();

                $modalEditContact.find('[name=contact_id]').val(id);
                $modalEditContact.find('[name=name]').val(name);
                $modalEditContact.find('[name=phone]').val(phone);
                $modalEditContact.modal('show');
            }
        })();
    </script>
@endsection
