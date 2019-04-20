@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">

                @if (session('notification'))
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('notification') }}
                    </div>
                @endif

                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">WhatsApp</h4>

                    <p>Ingrese un número de celular, y así mismo un mensaje.</p>

                    <form action="" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" placeholder="55 9999 9999" data-mask="55 9999 9999" class="form-control" id="phone" name="phone" required>
                            <p class="help-block">No se admiten espacios ni caracteres especiales.</p>
                        </div>

                        <div class="form-group">
                            <label for="my_message">Mensaje</label>
                            <textarea name="message" id="my_message" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary" type="submit">
                            Enviar
                        </button>
                    </form>
                </div>

            </div><!-- container -->
        </div><!-- content -->

        <footer class="footer">
            2019 © PROSVAL - Envía WhatsApp vía Selenium.
        </footer>
    </div>
@endsection
