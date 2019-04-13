@extends('layouts.app')

@section('page-title', 'Nueva campaña (manual)')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">

                <div class="card-box">
                    <div class="alert alert-info text-primary">
                        Este es el primer paso. Defina un nombre para la nueva campaña. A continuación podrá definir los destinatarios.
                    </div>

                    <form action="/campaigns" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="manual">
                        <div class="form-group">
                            <label for="campaign_name">Nombre de la campaña</label>
                            <input type="text" name="name"
                                   placeholder="¿Sobre qué es esta campaña?" class="form-control" id="campaign_name" required>
                        </div>
                        <div class="form-group">
                            <label for="campaign_via">Vía o medio de envío de la campaña</label>
                            <select name="via" id="campaign_via" class="form-control">
                                <option value="">Tipo de envío</option>
                                <option value="SMS" selected>Mensaje SMS</option>
                                <option value="WhatsApp">WhatsApp</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn waves-effect waves-light btn-primary">
                                Continuar
                                <i class="fa fa-forward"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <footer class="footer">
            2017 - {{ date('Y') }} © PROSVAL.
        </footer>
    </div>
@endsection
