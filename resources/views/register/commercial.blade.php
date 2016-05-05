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
                    {{ Form::select('sector_id', $sectors, $enterprise->sector_id, ['class' => 'form-control chosen-select' . ($errors->has('sector_id') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('sector_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('sector_id') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('enterprise_type_id', 'Tipo de empresa: ', ['class' => 'label-span-8']) }}
                    {{ Form::select('enterprise_type_id', $enterprise_types, $commercial->enterprise_type_id, ['class' => 'form-control chosen-select' . ($errors->has('enterprise_type_id') ? ' has-error' : ''), 'step' => 'any', 'aria-describedby' => 'label-incomes', 'required' => 'required' ]) }}
                    @if ($errors->has('enterprise_type_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('enterprise_type_id') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('num_employees', 'Número de empleados: ', ['class' => 'label-span-8']) }}
                    {{ Form::select('num_employees', getNumEmployeesOptions(), $commercial->num_employees, ['class' => 'form-control chosen-select' . ($errors->has('num_employees') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('num_employees'))
                      <span class="help-block">
                        <strong>{{ $errors->first('num_employees') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    {!! Form::label('year_established', 'Año en que se estableció: ', ['class' => 'label-span-8']) !!}
                    {!! Form::text('year_established', isset($commercial->year_established) ? getDateFormat(createDateFromFormat($commercial->year_established, 'Y-m-d'), 'd/m/Y') : $date, ['class' => 'form-control text-right datetimepicker-date' . ($errors->has('year_established') ? ' has-error' : ''), 'required' => 'required']) !!}
                    @if ($errors->has('year_established'))
                      <span class="help-block">
                        <strong>{{ $errors->first('year_established') }}</strong>
                      </span>
                    @endif

                  </div>
                </div>
                <div class="form-rows col-xs-12 no-padding">
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('products_and_services', 'Productos/Servicios: ', ['class' => 'label-span-8']) }}
                    {{ Form::text('products_and_services', arrayToTags($commercial->products_and_services, ",,;"), ['class' => 'form-control tags-input' . ($errors->has('products_and_services') ? ' has-error' : ''), 'placeholder' => 'Descripción de la empresa...', 'required' => 'required']) }}
                    @if ($errors->has('products_and_services'))
                      <span class="help-block">
                        <strong>{{ $errors->first('products_and_services') }}</strong>
                      </span>
                    @endif

                  </div>
                  <div class="col-xs-12 col-sm-6">
                    
                    {{ Form::label('affiliations', 'Afiliaciones: ', ['class' => 'label-span-8']) }}
                    {{ Form::text('affiliations', arrayToTags($commercial->affiliations, ",,;"), ['class' => 'form-control tags-input' . ($errors->has('affiliations') ? ' has-error' : '') ]) }}
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
                    {{ Form::text('certifications', arrayToTags($commercial->certifications, ",,;"), ['class' => 'form-control tags-input' . ($errors->has('certifications') ? ' has-error' : '') ]) }}
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