@extends('layouts.register')
@section('title', 'Información Comercial | AEM')
@section('specific-height', 'data-adaptable-style="true" data-style="min-height:99.9"')
@section('body-classes', 'bg-register')
@section('content-classes', 'overflow-hidden')
@section('content')
<div class="space-20px"></div>
<div class="container-fluid">
  <div class="row">
    <div class="register-container">
      <div class="register-form">
        {{ Form::open(['route' => 'register.commercial.store', 'method' => 'POST', 'id' => 'register_form']) }}
          <div class="col-xs-12">
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="col-xs-12">
                <h1 class="special-title-1 padding"> INFORMACIÓN COMERCIAL </h1>
              </div>
              <div class="col-xs-12">
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">

                    {{ Form::label('sector_id', 'Sector/Industria: ', ['class' => 'label-span-8']) }}
                    {{ Form::select('sector_id', $sectors, $enterprise->sector->key_name, ['class' => 'form-control chosen-select' . ($errors->has('sector_id') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('sector_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('sector_id') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('enterprise_type_id', 'Tipo de empresa: ', ['class' => 'label-span-8']) }}
                    {{ Form::select('enterprise_type_id', $enterprises_types, $enterprise->type->key_name, ['class' => 'form-control chosen-select' . ($errors->has('enterprise_type_id') ? ' has-error' : ''), 'step' => 'any', 'required' => 'required' ]) }}
                    @if ($errors->has('enterprise_type_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('enterprise_type_id') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('enterprise_num_employees_id', 'Número de empleados: ', ['class' => 'label-span-8']) }}
                    {{ Form::select('enterprise_num_employees_id', $enterprises_num_employees, $enterprise->num_employees->key_name, ['class' => 'form-control chosen-select' . ($errors->has('enterprise_num_employees_id') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('enterprise_num_employees_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('enterprise_num_employees_id') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    {!! Form::label('year_established', 'Año en que se estableció: ', ['class' => 'label-span-8']) !!}
                    {!! Form::text('year_established', (isset($enterprise->year_established) && $enterprise->year_established != '0000-00-00') ? getDateFormat(createDateFromFormat($enterprise->year_established, 'Y-m-d'), 'd/m/Y') : $date, ['class' => 'form-control text-right datetimepicker-date' . ($errors->has('year_established') ? ' has-error' : ''), 'required' => 'required']) !!}
                    @if ($errors->has('year_established'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_established') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('products', 'Productos/Servicios: ', ['class' => 'label-span-8']) }}
                    {{ Form::text('products', arrayToTags($enterprise->products_to_array(), ",,;"), ['class' => 'form-control tags-input' . ($errors->has('products') ? ' has-error' : ''), 'placeholder' => 'Descripción de la empresa...', 'required' => 'required']) }}
                    @if ($errors->has('products'))
                      <span class="help-block">
                        <strong>{{ $errors->first('products') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('affiliations', 'Afiliaciones: ', ['class' => 'label-span-8']) }}
                    {{ Form::text('affiliations', arrayToTags($enterprise->affiliations_to_array(), ",,;"), ['class' => 'form-control tags-input' . ($errors->has('affiliations') ? ' has-error' : '') ]) }}
                    @if ($errors->has('affiliations'))
                      <span class="help-block">
                        <strong>{{ $errors->first('affiliations') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('certifications', 'Certificaciones: ', ['class' => 'label-span-8']) }}
                    {{ Form::text('certifications', arrayToTags($enterprise->certifications_to_array(), ",,;"), ['class' => 'form-control tags-input' . ($errors->has('certifications') ? ' has-error' : '') ]) }}
                    @if ($errors->has('certifications'))
                      <span class="help-block">
                        <strong>{{ $errors->first('certifications') }}</strong>
                      </span>
                    @endif                  
  
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    &nbsp;
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