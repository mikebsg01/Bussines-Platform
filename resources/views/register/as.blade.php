@extends('layouts.register')
@section('title', 'Registrarse como | AEM')
@section('specific-height', 'data-adaptable-style="true" data-style="min-height:99.9"')
@section('body-classes', 'bg-register')
@section('content-classes', 'overflow-hidden')
@section('content')
<div class="space-30px"></div>
<div class="container-fluid">
  <div class="row">
    <div class="register-container">
      <div class="register-form">
        {{ Form::open(['route' => 'register.as.store', 'method' => 'POST', 'id' => 'register_form']) }}
          <div class="col-xs-12">
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="col-xs-12">
                <h1 class="special-title-1 padding"> REGISTRARSE COMO: </h1>
              </div>
              <div class="col-xs-12">

                @foreach( $roles as $key => $value )

                <div class="col-xs-12">
                  <div class="space-20px"></div>
                  {{ Form::radio('role_id', $key, $key === $enterprise_role, ['id' => $key, 'data-role' => 'input-radio', 'data-title' => cucfirst($value), 'required' => 'required']) }}
                </div>

                @endforeach

              </div>
              <div class="col-xs-12">

                @if ($errors->has('role_id'))
                <span class="help-block margin-top-15px">
                  <strong>{{ $errors->first('role_id') }}</strong>
                </span>
                @endif

              </div>
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
<div class="space-20px"></div>
@endsection