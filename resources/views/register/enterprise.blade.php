@extends('layouts.register')
@section('title', 'Mi Empresa | AEM')
@section('specific-height', 'data-adaptable-style="true" data-style="min-height:99.9"')
@section('body-classes', 'bg-register')
@section('content-classes', 'overflow-hidden')
@section('content')
<div class="space-20px"></div>
<div class="container-fluid">
  <div class="row">
    <div class="register-container">
      <div class="register-form">
        {{ Form::open(['route' => 'register.enterprise.store', 'files' => true, 'method' => 'POST', 'id' => 'register_form']) }}
          <div class="col-xs-12">
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="col-xs-12">
                <h1 class="special-title-1 padding"> INFORMACIÓN DE LA EMPRESA </h1>
              </div>
              <div class="col-xs-12">
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">

                    {{ Form::label('name', 'Nombre de la empresa: ') }}
                    {{ Form::text('name', old('name') ?: $enterprise->name, ['class' => 'form-control' . ($errors->has('name') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">

                    {{ Form::label('url_logo', 'Logotipos: ') }}
                    {{ Form::file('url_logo', ['class' => 'form-control' . ($errors->has('url_logo') ? ' has-error' : '') ]) }}
                    @if ($errors->has('url_logo'))
                      <span class="help-block">
                        <strong>{{ $errors->first('url_logo') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('description', 'Descripción: ') }}
                    {{ Form::text('description', old('description') ?: $enterprise->description, ['class' => 'form-control' . ($errors->has('description') ? ' has-error' : ''), 'placeholder' => 'Descripción de la empresa...', 'required' => 'required']) }}
                    @if ($errors->has('description'))
                      <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('fiscal_name', 'Razón Social ') }}
                    {{ Form::text('fiscal_name', old('fiscal_name') ?: $enterprise->fiscal_name, ['class' => 'form-control' . ($errors->has('fiscal_name') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('fiscal_name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('fiscal_name') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {!! Form::label('country_id', 'País') !!}
                    {!! Form::select('country_id', $countries, old('country_id') ?: $enterprise->country_id, ['class' => 'form-control' . ($errors->has('country_id') ? ' has-error' : ''), 'required' => 'required']) !!}
                    @if ($errors->has('country_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('country_id') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('state', 'Estado: ') }}
                    {{ Form::text('state', old('state') ?: $enterprise->state, ['class' => 'form-control' . ($errors->has('state') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('state'))
                      <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('aem_type_id', 'Capítulo AEM: ') }}
                    {{ Form::select('aem_type_id', \App\AEM_Type::getOptions(), old('aem_type_id') ?: $enterprise->aem_type_id, ['class' => 'form-control' . ($errors->has('aem_type_id') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('aem_type_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('aem_type_id') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('address', 'Dirección: ') }}
                    {{ Form::text('address', old('address') ?: $enterprise->address, ['class' => 'form-control' . ($errors->has('address') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('address'))
                      <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('codepostal', 'Código Postal: ') }}
                    {{ Form::text('codepostal', old('codepostal') ?: $enterprise->codepostal, ['class' => 'form-control' . ($errors->has('codepostal') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('codepostal'))
                      <span class="help-block">
                        <strong>{{ $errors->first('codepostal') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('phone_lada_id', 'Teléfono: ') }}
                    <div class="col-xs-12 no-padding">
                      <div class="col-xs-5 no-padding-left">
                        {!! Form::select('phone_lada_id', $ladas, old('phone_lada_id') ?: $enterprise->phone_lada_id, ['class' => 'form-control' . ($errors->has('phone_lada_id') ? ' has-error' : ''), 'required' => 'required']) !!}
                      </div>
                      <div class="col-xs-7 no-padding">
                        {{ Form::tel('phone_number', old('phone_number') ?: $enterprise->phone_number, ['class' => 'form-control' . ($errors->has('phone_number') ? ' has-error' : ''), 'required' => 'required']) }}
                      </div>
                      @if ($errors->has('phone_lada_id'))
                        <span class="help-block">
                          <strong>{{ $errors->first('phone_lada_id') }}</strong>
                        </span>
                      @endif
                      @if ($errors->has('phone_number'))
                        <span class="help-block">
                          <strong>{{ $errors->first('phone_number') }}</strong>
                        </span>
                      @endif
                    </div>

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('email', 'Correo electrónico: ') }}
                    {{ Form::text('email', old('email') ?: $enterprise->email, ['class' => 'form-control' . ($errors->has('email') ? ' has-error' : ''), 'placeholder' => 'example@mail.com', 'required' => 'required']) }}
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('url_website', 'Sitio web (URL): ') }}
                    {{ Form::url('url_website', old('url_website') ?: $enterprise->url_website, ['class' => 'form-control' . ($errors->has('url_website') ? ' has-error' : ''), 'placeholder' => 'http://www.example.com' ]) }}
                    @if ($errors->has('url_website'))
                      <span class="help-block">
                        <strong>{{ $errors->first('url_website') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
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