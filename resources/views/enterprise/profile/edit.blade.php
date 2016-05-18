@extends('layouts.app')
@section('title', 'Perfil | ' . $enterprise->name)
@section('specific-height', '')
@section('content-classes', '')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="profile-header col-xs-12 col-md-12">    
      <div class="col-xs-2 col-xs-offset-1 no-padding">
        @if (is_null($enterprise->url_logo))
          <a href="#" data-viewer-type="image" data-viewer-file="{{asset('assets/img/not-image.png')}}" class="thumbnail profile-logo"></a>
        @else
          <a href="#" data-viewer-type="image" data-viewer-file="{{asset('images/enterprises/'.$enterprise->url_logo)}}" class="thumbnail profile-logo"></a>
        @endif
      </div>
      <div class="profile-header-container col-xs-9">
        <div class="col-xs-12 no-padding">
          <h1 class="profile-name">{{ $enterprise->name }}</h1>
        </div>
        <div class="profile-features col-xs-12 no-padding">
          <div class="col-xs-3 no-padding">
            <h3 class="inline-block"> Puntuación: </h3>
            <div class="inline-block">
              <select class="barrating-1">
                <option value="">0</option>
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          <div class="col-xs-3 text-center no-padding">
            <h4 class="inline-block">
              <span class="fa fa-map-marker"></span> 
              {{ $enterprise->city }}, {{ $enterprise->state }}
            </h4>
          </div>
          <div class="col-xs-3 text-center no-padding">
            <h4 class="inline-block">
              <span class="fa fa-birthday-cake"></span>
              Fundadada en {{ $enterprise->commercial->founded }}
            </h4>
          </div>
          <div class="col-xs-2 text-center no-padding">
            <a href="{{ route('enterprise.profile', ['slug' => $enterprise->slug]) }}" class="inline-block hvr-wobble-vertical">
              Ver perfil
              <span class="fa fa-eye"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 special-padding-4">
      <div class="col-xs-3 special-padding-3">
        <ul class="nav nav-pills nav-stacked profile-nav-stacked" role="tablist">
          <li role="presentation" class="active">
            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="text-center">Perfil</a>
          </li>
          <li role="presentation">
            <a href="#my-meetings" aria-controls="my-meetings" role="tab" data-toggle="tab" class="text-center">Mis citas<span class="badge">4</span></a>
          </li>
          <li role="presentation">
            <a href="#pending" aria-controls="pending" role="tab" data-toggle="tab" class="text-center">Citas pendientes</a>
          </li>
        </ul>
      </div>
      <div class="col-xs-9 no-padding">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="profile">
            <div class="col-xs-8 no-padding special-padding-2">
              <div class="col-xs-12 no-padding">
                <h2 class="special-title-6"> DESCRIPCIÓN DE LA EMPRESA </h2>
              </div>
              <div class="col-xs-12 no-padding profile-description bottom-margin">
                <div class="col-xs-12 no-padding top-margin">
                  {!! Form::textarea('description', $enterprise->description, ['class' => 'form-control', 'rows' => '5', 'required' => 'required']) !!}
                </div>
              </div>
              <div class="col-xs-12 no-padding">
                <div class="divider"></div>
              </div>
              <div class="col-xs-12 no-padding">
                <h2 class="special-title-6 margin-top-30px"> INFORMACIÓN COMERCIAL </h2>
              </div>
              <div class="col-xs-12 no-padding profile-commercial bottom-margin">
                <div class="col-xs-12 no-padding top-margin">
                  <div class="col-xs-6 no-padding">
                    <h3> Sector/Industria: </h3>
                  </div>
                  <div class="col-xs-6">
                    <p class="text-center"> 
                      {{ Form::select('sector_id', \App\Sector::getOptions(), $enterprise->sector_id, ['class' => 'form-control chosen-select' . ($errors->has('sector_id') ? ' has-error' : ''), 'required' => 'required']) }}
                    </p>
                  </div>
                </div>
                <div class="col-xs-12 no-padding top-margin">
                  <div class="col-xs-6 no-padding">
                    <h3> Productos/Servicios: </h3>
                  </div>
                  <div class="col-xs-6">
                    <p class="text-center">
                      {{ Form::text('products_and_services', arrayToTags($enterprise->commercial->products_and_services, ",,;"), ['class' => 'form-control tags-input' . ($errors->has('products_and_services') ? ' has-error' : ''), 'placeholder' => 'Descripción de la empresa...' ]) }}
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 no-padding">
                <div class="divider"></div>
              </div>
              <div class="col-xs-12 no-padding">
                <h2 class="special-title-6 margin-top-30px"> DETALLES DE LA EMPRESA </h2>
              </div>
              <div class="col-xs-12 no-padding profile-details">
                <div class="col-xs-12 no-padding margin-top-15px">
                  <div class="col-xs-6 no-padding">
                    <h3> Razón Social: </h3>
                  </div>
                  <div class="col-xs-6">
                    <p class="text-center">
                      {!! Form::text('fiscal_name', $enterprise->fiscal_name, ['class' => 'form-control']) !!}
                    </p>
                  </div>
                </div>
                <div class="col-xs-12 no-padding margin-top-15px">
                  <div class="col-xs-6 no-padding">
                    <h3> No. Empleados: </h3>
                  </div>
                  <div class="col-xs-6">
                    <p class="text-center">
                      {!! Form::select('num_employees', getNumEmployeesOptions(), $enterprise->commercial->num_employees, ['class' => 'form-control chosen-select' . ($errors->has('num_employees') ? ' has-error' : ''), 'required' => 'required']) !!}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-4 special-padding-3">
              <div class="col-xs-12 no-padding">
                <h2 class="special-title-7"> INFORMACIÓN DE CONTACTO </h2>
              </div>
              <div class="col-xs-12 no-padding profile-contact bottom-margin">
                <div class="col-xs-12 no-padding top-margin">
                  <p>

                    {{ Form::label('email', 'Correo electrónico: ') }}
                    {{ Form::text('email', old('email') ?: $enterprise->email, ['class' => 'form-control' . ($errors->has('email') ? ' has-error' : ''), 'placeholder' => 'example@mail.com', 'required' => 'required']) }}
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif

                  </p>
                </div>
                <div class="col-xs-12 no-padding top-margin">
                  <p>

                    {{ Form::label('address', 'Dirección: ') }}
                    {{ Form::text('address', old('address') ?: $enterprise->address, ['class' => 'form-control' . ($errors->has('address') ? ' has-error' : ''), 'required' => 'required']) }}
                    @if ($errors->has('address'))
                      <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                      </span>
                    @endif

                  </p>
                </div>
                <div class="col-xs-12 no-padding top-margin">
                  <p>

                    {!! Form::label('phone_lada_id', 'Teléfono: ') !!}
                    <div class="col-xs-12 no-padding">
                      <div class="col-xs-5 no-padding-left">
                        {!! Form::select('phone_lada_id', \App\Lada::getLadaOptions(), old('phone_lada_id') ?: $enterprise->phone_lada_id, ['class' => 'form-control' . ($errors->has('phone_lada_id') ? ' has-error' : ''), 'required' => 'required']) !!}
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

                  </p>
                </div>
                <div class="col-xs-12 no-padding top-margin">
                  <p>
                    {{ Form::label('url_website', 'Sitio web (URL): ') }}
                    {!! Form::url('url_website', old('url_website') ?: $enterprise->url_website, ['class' => 'form-control' . ($errors->has('url_website') ? ' has-error' : ''), 'placeholder' => 'http://www.example.com' ]) !!}
                    @if ($errors->has('url_website'))
                      <span class="help-block">
                        <strong>{{ $errors->first('url_website') }}</strong>
                      </span>
                    @endif

                  </p>
                </div>
              </div>
              <div class="col-xs-12 no-padding">
                <div class="divider"></div>
              </div>
              <div class="col-xs-12 no-padding">
                <h2 class="special-title-7 margin-top-30px"> REDES SOCIALES </h2>
                <div class="col-xs-12 no-padding bottom-margin profile-social">

                  <div class="top-margin">
                    {!! Form::label('url_fb', 'Facebook:') !!}
                    {!! Form::text('url_fb', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="top-margin">
                    {!! Form::label('url_tw', 'Twitter:') !!}
                    {!! Form::text('url_tw', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="top-margin">
                    {!! Form::label('url_in', 'LinkedIn:') !!}
                    {!! Form::text('url_in', null, ['class' => 'form-control']) !!}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12 no-padding margin-top-15px">
              <div class="col-xs-8 no-padding special-padding-2 text-center">
                {!! Form::submit('Guardar cambios', ['class' => 'special-btn special-btn-red margin-top-15px']) !!}
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="my-meetings">B</div>
          <div role="tabpanel" class="tab-pane" id="pending">C</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection