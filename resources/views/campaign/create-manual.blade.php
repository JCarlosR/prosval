@extends('layouts.app')

@section('page-title', 'Nueva campaña (manual)')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">

                <div class="card-box">
                    <form action="/campaigns" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="manual">
                        <div class="form-group">
                            <label for="campaign_name">Nombre campaña</label>
                            <input type="text" name="name"
                                   placeholder="Escribir nombre de campaña" class="form-control" id="campaign_name" required>
                            <span class="help-block">
                            Ingrese un nombre para la nueva campaña y a continuación podrá definir los destinatarios.
                        </span>
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
            2017 © PROSVAL.
        </footer>
    </div>
@endsection
