@extends('layouts.app')

@section('page-title', 'Lista de contactos')

@section('content')     
@include('contact.modal.create')
@include('contact.modal.edit')

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="dropdown pull-right">
                             <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#modalAddContact">Nuevo</button>
                        </div>

                        <h4 class="header-title m-t-0 m-b-30">Datos de contacto</h4>

                        @if (session('notification'))
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('notification') }}
                        </div>
                        @endif

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
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td data-name>{{ $contact->name }}</td>
                                    <td data-phone>{{ $contact->phone }}</td>
                                    <td data-email>{{ $contact->email }}</td>
                                    <td data-type>{{ $contact->type }}</td>
                                    <td data-colony="{{ $contact->colony_id }}">{{ $contact->colony ? $contact->colony->name : 'Sin asignar' }}</td>
                                    <td data-link>{{ $contact->link }}</td>
                                    <td>Activo</td>
                                    <td>
                                        <button class="btn btn-sm waves-effect waves-light btn-success m-b-5" data-edit="{{ $contact->id }}" title="Editar contacto">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="{{ url('/contact/'.$contact->id.'/spam') }}" class="btn btn-sm waves-effect waves-light btn-danger m-b-5" title="Marcar como spam">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

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
                var email = $tr.find('[data-email]').text();
                var type = $tr.find('[data-type]').text();
                var link = $tr.find('[data-link]').text();
                var colony_id = $tr.find('[data-colony]').data('colony');
                var colony = $tr.find('[data-colony]').text();
                // console.log(colony_id);

                $modalEditContact.find('[name=contact_id]').val(id);
                $modalEditContact.find('[name=name]').val(name);
                $modalEditContact.find('[name=phone]').val(phone);
                $modalEditContact.find('[name=email]').val(email);
                $modalEditContact.find('[name=type]').val(type);
                $modalEditContact.find('[name=link]').val(link);
                $modalEditContact.find('[name=colony_id]').val(colony_id).trigger('change');
                /*$modalEditContact.find('[name=colony_id]')
                    .select2('data', {id: colony_id, a_key: colony});*/
                $modalEditContact.modal('show');
            }
        })();
    </script>
@endsection
