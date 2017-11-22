@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">

                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Registro</h4>

                    <form class="m-t-20" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center m-t-40">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Registrar nuevo usuario <i class="fa fa-save"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
