@extends('layouts.app')
@section('title', 'Registro | AEM')
@section('specific-height', '')
@section('content-classes', '')
@section('content')
<div class="space-40px"></div>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-md-12">
      <div class="col-xs-12 col-sm-2 col-md-4 col-lg-4"></div>
      <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
        <div class="signup-container">
          <h1 class="fg-red title text-center">FORMULARIO DE REGISTRO</h1>
          <h3 class="subtitle text-center">Datos de acceso</h3>
          <div class="signup-form">
            {!! Form::open(['method' => 'POST']) !!}

              {!! Form::label('email', 'Correo electrónico: ', ['class' => 'special-label-1']) !!}
              {!! Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' has-error' : ''), 'required' => 'required']) !!}
              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif

              {!! Form::label('password', 'Contraseña: ', ['class' => 'special-label-1']) !!}
              {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' has-error' : ''), 'required' => 'required']) !!}
              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif

              {!! Form::label('password_confirmation', 'Confirmar contraseña: ', ['class' => 'special-label-1']) !!}
              {!! Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' has-error' : ''), 'required' => 'required']) !!}
              @if ($errors->has('password_confirmation'))
                <span class="help-block">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
              @endif

              <h3 class="special-label-2 fg-red margin-top-30px"> INFORMACIÓN PERSONAL </h3>
              <div class="col-xs-12 col-md-12 form-columns-2a no-padding">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding-left">

                  {!! Form::label('first_name', 'Nombre: ', ['class' => 'special-label-1']) !!}
                  {!! Form::text('first_name', old('first_name'), ['class' => 'form-control' . ($errors->has('first_name') ? ' has-error' : ''), 'required' => 'required']) !!}
                  @if ($errors->has('first_name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                  @endif

                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding-right">

                  {!! Form::label('last_name', 'Apellidos: ', ['class' => 'special-label-1']) !!}
                  {!! Form::text('last_name', old('last_name'), ['class' => 'form-control' . ($errors->has('last_name') ? ' has-error' : ''), 'required' => 'required']) !!}
                  @if ($errors->has('last_name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                  @endif

                </div>
              </div>
              <div class="col-xs-12 col-md-12 form-columns-2a no-padding">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding-left">

                  {!! Form::label('phone_lada_id', 'Celular: ', ['class' => 'special-label-1']) !!}
                  {!! Form::select('phone_lada_id', App\Lada::getOptions(), null, ['class' => 'form-control' . ($errors->has('phone_lada_id') ? ' has-error' : ''), 'required' => 'required']) !!}
                  @if ($errors->has('phone_lada_id'))
                    <span class="help-block">
                      <strong>{{ $errors->first('phone_lada_id') }}</strong>
                    </span>
                  @endif

                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding-right">

                  {!! Form::label('phone_number', '&nbsp;', ['class' => 'special-label-1']) !!}
                  {!! Form::tel('phone_number', null, ['class' => 'form-control' . ($errors->has('phone_number') ? ' has-error' : ''), 'placeholder' => 'Tu número...', 'required' => 'required']) !!}
                  @if ($errors->has('phone_number'))
                    <span class="help-block">
                      <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                  @endif

                </div>
              </div>
              <div class="col-xs-12 no-padding">
                <div class="space-10px"></div>
                <div class="col-xs-9 no-pading">  
                  <div class="conditions-group">

                    {!! Form::checkbox('agree', true, null, ['id' => 'agree', 'required' => 'required']) !!}
                    <label for="agree">Acepto <a href="#" class="fg-red">Términos y Condiciones.</a> </label>
                    @if ($errors->has('agree'))
                      <span class="help-block" style="margin-left: 3.7%;">
                        <strong>{{ $errors->first('agree') }}</strong>
                      </span>
                    @endif

                  </div>
                </div> 
                <div class="col-xs-3 no-padding">
                  {!! Form::submit('Enviar', ['class' => 'special-btn special-btn-small special-btn-red pull-right margin-top-10px']) !!}
                </div>
              </div>
              <div class="col-xs-12 col-md-12 no-padding">
                <div class="space-20px"></div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-2 col-md-4 col-lg-4"></div>
    </div>
  </div>
</div>
@endsection