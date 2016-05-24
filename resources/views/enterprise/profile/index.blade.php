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
          <h1 class="profile-name">
            {{ $enterprise->name }}
            <sup>
              <span class="fa fa-check-circle cursor-pointer" data-toggle="tooltip" data-placement="right" title="Empresa verificada"></span>
            </sup>
          </h1>
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
              <span class="fa fa-star"></span> 
              {{ txti18n('aem_chapters', $enterprise->aem_chapter->key_name) }}
            </h4>
          </div>
          <div class="col-xs-3 text-center no-padding">
            <h4 class="inline-block">
              <span class="fa fa-birthday-cake"></span>
              Fundadada en {{ $enterprise->founded }}
            </h4>
          </div>
          <div class="col-xs-2 text-center no-padding">
            @can('view-enterprise-data', $enterprise)
              <a href="{{ route('enterprise.profile.edit', ['slug' => $enterprise->slug]) }}" class="inline-block hvr-wobble-vertical">
                Editar perfil
                <span class="fa fa-pencil"></span>
              </a>
            @endcan
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
        @can('view-enterprise-data', $enterprise)
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
        @else 
          {{ "pay per view" }}
        @endcan
      </div>
      <div class="col-xs-9 no-padding">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="profile">
            <div class="col-xs-8 special-padding-2 data-container main-space">
              <div class="col-xs-12 no-padding data-box">
                <h3 class="data-title"> DESCRIPCIÓN DE LA EMPRESA </h3>
                <div class="col-xs-12 no-padding">
                  <p class="data-content">
                    {{ $enterprise->description }}
                  </p>
                </div>
              </div>
              <div class="col-xs-12 no-padding data-box">
                <div class="col-xs-12 no-padding">
                  <h3 class="data-title"> INFORMACIÓN COMERCIAL </h3>
                </div>
                <div class="col-xs-12 no-padding">
                  <div class="col-xs-6 no-padding">
                    <h4 class="data-label"> 
                      Perfil:
                    </h4> 
                  </div>
                  <div class="col-xs-6 no-padding">
                    <p class="data-content text-center">
                      @if ($enterprise->roles->count() > 0)
                        {{ txti18n('roles', $enterprise->roles->first()->key_name) }}
                      @endif
                    </p>
                  </div>
                </div>
                <div class="col-xs-12 no-padding">
                  <div class="col-xs-6 no-padding">
                    <h4 class="data-label"> 
                      Sector / Industria:
                    </h4> 
                  </div>
                  <div class="col-xs-6 no-padding">
                    <p class="data-content text-center">
                      {{ $enterprise->sector->key_name }}
                    </p>
                  </div>
                </div>
                <div class="col-xs-12 no-padding">
                  <div class="col-xs-6 no-padding">
                    <h4 class="data-label"> 
                      Productos / Servicios:
                    </h4> 
                  </div>
                  <div class="col-xs-6 no-padding">
                    <p class="data-content">
                      @foreach ($enterprise->products as $product)
                        <a href="#" class="chip special-text-1">
                            {{ $product->name }}
                        </a>
                      @endforeach
                    </p>
                  </div>
                </div>
                <div class="col-xs-12 no-padding">
                  <div class="col-xs-6 no-padding">
                    <h4 class="data-label"> 
                      Afiliaciones:
                    </h4> 
                  </div>
                  <div class="col-xs-6 no-padding">
                    <p class="data-content">
                      @foreach ($enterprise->affiliations as $affiliation)
                        <a href="#" class="chip special-text-1">
                          {{ $affiliation->name }}
                        </a>
                      @endforeach
                    </p>
                  </div>
                </div>
                <div class="col-xs-12 no-padding">
                  <div class="col-xs-6 no-padding">
                    <h4 class="data-label"> 
                      Certificaciones:
                    </h4> 
                  </div>
                  <div class="col-xs-6 no-padding">
                    <p class="data-content">
                      @foreach ($enterprise->certifications as $certification)
                        <a href="#" class="chip special-text-1">
                          {{ $certification->name }}
                        </a>
                      @endforeach
                    </p>
                  </div>
                </div>
              </div>
              @can('view-enterprise-data', $enterprise)
                <div class="col-xs-12 no-padding data-box">
                  <div class="col-xs-12 no-padding">
                    <h3 class="data-title"> DETALLES DE LA EMPRESA </h3>
                  </div>
                  <div class="col-xs-12 no-padding">
                    <div class="col-xs-6 no-padding">
                      <h4 class="data-label"> 
                        Razón Social:
                      </h4> 
                    </div>
                    <div class="col-xs-6 no-padding">
                      <p class="data-content text-center">
                        {{ $enterprise->fiscal_name }}
                      </p>
                    </div>
                  </div>
                  <div class="col-xs-12 no-padding">
                    <div class="col-xs-6 no-padding">
                      <h4 class="data-label"> 
                        Tamaño de la empresa:
                      </h4> 
                    </div>
                    <div class="col-xs-6 no-padding">
                      <p class="data-content text-center">
                        {{ cucfirst($enterprise->type->key_name) }}
                      </p>
                    </div>
                  </div>
                  <div class="col-xs-12 no-padding">
                    <div class="col-xs-6 no-padding">
                      <h4 class="data-label"> 
                        Número de empleados:
                      </h4> 
                    </div>
                    <div class="col-xs-6 no-padding">
                      <p class="data-content text-center">
                        {{ txti18n('enterprise_num_employees', $enterprise->num_employees->key_name) }}
                      </p>
                    </div>
                  </div>
                </div>
              @endcan
            </div>
            <div class="col-xs-4 special-padding-3 data-container">
              @can('view-enterprise-data', $enterprise)
                <div class="col-xs-12 no-padding data-box-mini">
                  <h3 class="data-title"> INFORMACIÓN DE CONTACTO </h3>
                  <div class="col-xs-12 no-padding">
                    <h4 class="data-label"> 
                      Correo electrónico:
                    </h4> 
                  </div>
                  <div class="col-xs-12 no-padding">
                    <p class="data-content">
                      <a href="mailto:{{ $enterprise->email }}">
                        {{ $enterprise->email }}
                      </a>
                    </p>
                  </div>
                  <div class="col-xs-12 no-padding">
                    <h4 class="data-label"> 
                      Ubicación:
                    </h4> 
                  </div>
                  <div class="col-xs-12 no-padding">
                    <p class="data-content">
                      {{ $enterprise->address }}, 
                      C.P. {{ $enterprise->codepostal }},
                      {{ $enterprise->state }}, {{ txti18n('countries', $enterprise->country->key_name) }}.
                    </p>
                  </div>
                  <div class="col-xs-12 no-padding">
                    <h4 class="data-label"> 
                      Teléfono:
                    </h4> 
                  </div>
                  <div class="col-xs-12 no-padding">
                    <p class="data-content">
                      {{ $enterprise->phone_lada_only_digits }}
                      {{ $enterprise->phone_number }}
                    </p>
                  </div>
                  <div class="col-xs-12 no-padding">
                    <h4 class="data-label"> 
                      Sitio web:
                    </h4> 
                  </div>
                  <div class="col-xs-12 no-padding">
                    <p class="data-content">
                      <a href="{{ $enterprise->url_website }}" target="__blank">
                        {{ $enterprise->url_website }}
                      </a>
                    </p>
                  </div>
                </div>
                <div class="col-xs-12 no-padding data-box-mini">
                  <h3 class="data-title"> REDES SOCIALES </h3>
                  <div class="col-xs-12 no-padding bottom-margin profile-social">
                    <span class="fa fa-facebook-square profile-icon profile-icon-fb"></span>
                    <span class="fa fa-twitter-square profile-icon profile-icon-tw"></span>
                    <span class="fa fa-linkedin-square profile-icon profile-icon-in"></span>
                  </div>
                </div>
              @else 
                <div class="col-xs-12 well">
                  {!! Form::open(['route' => 'enterprise.search', 'method' => 'POST']) !!}
                    <div class="col-xs-12 no-padding">
                      {!! Form::label('credit_card[number]', 'Número de tarjeta:') !!}
                    </div>
                    <div class="col-xs-12 no-padding bottom-margin">
                      {!! Form::text('credit_card[number]', '', ['class' => 'form-control', 'placeholder' => '1111 2222 3333 4444', 'id' => 'credit_card[number]']) !!}
                    </div>
                    <div class="col-xs-12 no-padding">
                      {!! Form::label('credit_card[expire_month]', 'Fecha de vencimiento:') !!}
                    </div>
                    <div class="col-xs-12 no-padding bottom-margin">
                      <div class="col-xs-6 no-padding-left">
                        {!! Form::text('credit_card[expire_month]', '', ['class' => 'form-control', 'placeholder' => '01']) !!}
                      </div>
                      <div class="col-xs-6 no-padding">
                        {!! Form::text('credit_card[expire_year]', '', ['class' => 'form-control', 'placeholder' => '2016']) !!}
                      </div>
                    </div>
                    <div class="col-xs-12 no-padding">
                      {!! Form::label('credit_card[cvv2]', 'Código de seguridad:') !!}
                    </div>
                    <div class="col-xs-12 no-padding bottom-margin">
                      <div class="col-xs-7 no-padding">
                        {!! Form::text('credit_card[cvv2]', '', ['class' => 'form-control', 'placeholder' => 'xxx']) !!}
                      </div>
                    </div>
                    <div class="col-xs-12 no-padding bottom-margin">
                      <div class="col-xs-1 no-padding">
                        {{ Form::checkbox('credit_card[accept]', '1', false, ['required' => 'required']) }}
                      </div>
                      <div class="col-xs-11 no-padding">
                        <p>
                          Estoy de acuerdo con la recopilación de mis datos financieros por parte de AEM para su uso en los propósitos previamente expresados, tal como se encuentra detallado en la Política de Privacidad de AEM.
                        </p>
                      </div>
                    </div>
                    <div class="col-xs-12 no-padding bottom-margin">
                      <p>
                        Las tarjetas de crédito pueden estar sujetas a ajustes
                        debido a las comisiones y cargos adicionales
                        establecidos por tu banco.
                      </p>
                    </div>
                    <div class="col-xs-12 no-padding text-center">
                      <button class="special-btn special-btn-small special-btn-red btn-lg">
                        Hacer cita
                      </button>
                    </div>
                  {!! Form::close() !!}
                </div>
              @endcan
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