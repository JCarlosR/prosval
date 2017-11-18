@extends('layouts.inicio')

@section('content')
<div class="text-center">
    <h4 class="text-uppercase font-bold m-b-0">Login</h4>
</div>

<div class="panel-body">
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group ">
            <div class="col-xs-12">
                <div class="checkbox checkbox-custom">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup">
                        Recordar cuenta
                    </label>
                </div>

            </div>
        </div>

        <div class="form-group text-center m-t-30">
            <div class="col-xs-12">
                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Ingresar</button>
            </div>
        </div>

        {{--<div class="form-group m-t-30 m-b-0">--}}
            {{--<div class="col-sm-12">--}}
                {{--<a href="{{ route('password.request') }}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Olvidó su contraseña?</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </form>
</div>
@endsection
