<div id="modalEditContact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Editar contacto</h4>
            </div>
            <form method="post" action="/contact">
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
                                <input type="text" placeholder="55 9999 9999" data-mask="55 9999 9999" class="form-control" id="telefono" name="phone">
                                <span class="font-13 text-muted">Ejemplo: 55 8547 8484</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="correo" class="control-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo" class="control-label">Tipo</label>
                                <input type="text" class="form-control" id="tipo" name="type">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="colony_id" class="control-label">Colonia</label>
                                <select class="form-control select2" id="colony_id" name="colony_id">
                                    <option>Seleccione colonia</option>
                                    @foreach ($municipalities as $municipality)
                                        <optgroup label="{{ $municipality->name }}">
                                            @foreach ($municipality->colonies as $colony)
                                                <option value="{{ $colony->id }}">{{ $colony->name }} ({{ $colony->postal_code }})</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="link" class="control-label">Link</label>
                                <input type="url" class="form-control" name="link" id="link">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
