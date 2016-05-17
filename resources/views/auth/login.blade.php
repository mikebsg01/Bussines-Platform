@extends('layouts.app')
@section('title', 'Ingresar | AEM')
@section('specific-height', 'data-adaptable-style="true" data-style="min-height:86.9"')
@section('body-classes', '')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-md-12 no-padding">
      <div class="col-xs-6 no-padding">
        <div class="col-xs-12 trap-gray-aside-left" data-adaptable-style="true" data-style="min-height:31"></div>
        <div class="col-xs-12 no-padding margin-top-15px">
          <div class="col-xs-6">
            <p class="special-text-2"> 
              Con la plataforma de negocios AEM puedes obtener más oportunidades de negocio de manera fácil y efectiva.
            </p>
          </div>
        </div>
        <div class="col-xs-12 trap-red-aside-left" data-adaptable-style="true" data-style="min-height:33.7"></div>
      </div>
      <div class="col-xs-5 no-padding">
        <div class="space-70px"></div>
        <div class="space-40px"></div>
        <div class="col-xs-12">
          <div class="col-xs-8 col-xs-offset-2">
          {{ Form::open(['url' => url('/login')])  }}
            <div class="space-20px"></div>
            <div class="col-xs-12">
              <div class="margin-top-15px">
              {{ Form::label('email', 'CORREO ELECTRÓNICO', ['class' => 'special-title-4 margin-center text-center']) }}
              </div>

              <div class="margin-top-15px">
              {{ Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' has-error' : '')]) }}

              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif

              </div>

              <div class="margin-top-15px">
              {{ Form::label('password', 'CONTRASEÑA', ['class' => 'special-title-4 margin-center text-center']) }}
              </div>

              <div class="margin-top-15px">
              {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' has-error' : '')]) }}

                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

              </div>

              <div class="margin-top-15px">
                {{ Form::checkbox('remember') }}
                {{ Form::label('remember', 'Recordar sesión', ['class' => 'inline-block align-top']) }} 
                <p class="inline-block align-top">|</p>
                <a class="special-link-2 inline-block align-top" href="{{ url('/password/reset') }}">
                  Olvidé contraseña
                </a>
              </div>

              <div class="margin-top-15px">
              {{ Form::submit('INICIAR SESIÓN', ['class' => 'special-btn special-btn-red margin-center']) }}
              </div>
            </div>
          {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection