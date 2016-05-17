@extends('layouts.app')
@section('title', !empty($params['q']) ? 'Búsqueda: ' . $params['q'] . ' | AEM' : 'AEM | Buscador')
@section('specific-height', '')
@section('content-classes', '')
@section('content')
<!--<div class="space-30px"></div>-->
<div class="container-fluid">
  <div class="row">
    <!--<div class="col-xs-12">
      <div class="col-xs-6 col-xs-offset-3">
        {!! Form::open(['route' => 'enterprise.search','method' => 'GET']) !!}
          <div class="input-group search-input-group">
            {{ Form::text('q', isset($params['q']) ? $params['q'] : "", ['class' => 'form-control text-center', 'placeholder' => 'Buscar empresa, producto o servicio...']) }}
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default special-btn special-btn-red special-btn-small">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>-->
    <div class="col-xs-12 text-center">
      <p class="search-lbl inline-block"> 
        <b>Filtro:</b> 
        @if (isset($params['sectors']))
          {{ arrayToString($params['sectors'], ',') }}
        @endif
        &nbsp;
        -
        &nbsp;
        <b>Resultados:</b>
        {{ $results }}
      </p>
    </div>
    <div class="search-filters col-xs-12 no-padding">
      <div class="dropdown col-xs-3 no-padding">
        <button class="col-xs-12 btn btn-default dropdown-toggle special-title-4 fg-red" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Sector
          <span class="caret"></span>
        </button>
        <ul class="col-xs-12 dropdown-menu" data-role="filter" data-name="sectors"  aria-labelledby="dropdownMenu1">
          <?php $i = 0; ?>
          @foreach (\App\Sector::getOptions() as $key => $value)
            @if ($i > 1)
              <li>
                <a href="#" class="filter-option" data-value="{{$value}}">
                  {{$value}}
                  @if (in_array($value, isset($params['sectors']) ? $params['sectors'] : [] ))
                    <span class="fa fa-check fg-red pull-right"></span>
                  @endif
                </a>
              </li>
            @endif
            <?php ++$i; ?>
          @endforeach
        </ul>
      </div>
      <div class="dropdown col-xs-3 no-padding">
        <button class="col-xs-12 btn btn-default dropdown-toggle special-title-4 fg-red" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          País
          <span class="caret"></span>
        </button>
        <ul class="col-xs-12 dropdown-menu" data-role="filter" data-name="countries" aria-labelledby="dropdownMenu2">
          <?php $i = 0; ?>
          @foreach (\App\Country::getOptions() as $key => $value)
            @if ($i)
              <li>
                <a href="#" class="filter-option" data-value="{{ $value }}">
                  {{$value}}
                  @if (in_array($value, isset($params['countries']) ? $params['countries'] : [] ))
                    <span class="fa fa-check fg-red pull-right"></span>
                  @endif
                </a>
              </li>
            @endif
            <?php ++$i; ?>
          @endforeach
        </ul>
      </div>
      <div class="dropdown col-xs-3 no-padding">
        <button class="col-xs-12 btn btn-default dropdown-toggle special-title-4 fg-red" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Tipo de AEM
          <span class="caret"></span>
        </button>
        <ul class="col-xs-12 dropdown-menu" aria-labelledby="dropdownMenu3">
          <?php $i = 0; ?>
          @foreach (\App\AEM_Type::getOptions() as $key => $value)
            @if ($i == 1)
              <li><a href="#">{{$value}}</a></li>
            @endif
            <?php $i = 1; ?>
          @endforeach
        </ul>
      </div>
      <div class="dropdown col-xs-3 no-padding">
        <button class="col-xs-12 btn btn-default dropdown-toggle special-title-4 fg-red" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Status
          <span class="caret"></span>
        </button>
        <ul class="col-xs-12 dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="#">Verificada</a></li>
          <li><a href="#">No verificada</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    @if ($enterprises->count() == 0)
      <div class="col-xs-12 no-padding">
        <h3 class="col-xs-6 col-xs-offset-3 special-title-4 text-center card-panel fg-red margin-top-15px">Ningún resultado encontrado</h3>
      </div>
    @endif
    @foreach ($enterprises as $enterprise) 
      <div class="col-xs-12 enterprise">
        <div class="col-xs-3">
          @if (is_null($enterprise->url_logo))
            <a href="#" data-viewer-type="image" data-viewer-file="{{asset('assets/img/not-image.png')}}" class="thumbnail enterprise-logo"></a>
          @else
            <a href="#" data-viewer-type="image" data-viewer-file="{{asset('images/enterprises/'.$enterprise->url_logo)}}" class="thumbnail enterprise-logo"></a>
          @endif
        </div>
        <div class="col-xs-6">
          <div class="col-xs-12 no-padding special-text-4">
            <h2 class="special-title-8 inline-block"><a href="{{ route('enterprise.profile', ['slug' => $enterprise->slug]) }}">{{ $enterprise->name }}</a></h2>
            <h3 class="special-title-10 inline-block pull-right">{{ $enterprise->sector->name }}</h3>
            <p class="enterprise-description text-ellipsis">
              {{ $enterprise->short_description(250, '...') }}
            </p>
            <p>
              @if (!is_null($enterprise->commercial))
                <?php $products_and_services = json_decode($enterprise->commercial->products_and_services); ?>
                @foreach($products_and_services as $item)
                  <div class="chip special-text-1">
                    {{$item}}
                  </div>
                @endforeach
              @endif
            </p>
          </div>
          <div class="col-xs-12 no-padding top-margin">
            <div class="col-xs-4 no-padding">
              <p class="data">
                <span class="fa fa-map-marker"></span>
                {{ 
                  $enterprise->state . ', ' .  
                  $enterprise->country->value 
                }}
              </p>
            </div>
            <div class="col-xs-4 text-center no-padding">
              <p class="data">
                <span class="fa fa-star"></span>
                {{ 
                  $enterprise->aem_type->value
                }}
              </p>
            </div>
            <div class="col-xs-4 no-padding text-center">
              <label class="inline-block data"> Puntuación: </label>
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
          </div>
        </div>
        <div class="col-xs-3 text-center">
          <div class="space-30px"></div>
          <a href="{{ route('enterprise.profile', ['slug' => $enterprise->slug]) }}" class="special-btn special-btn-white">Ver perfil</a>
          <a href="#" class="special-btn special-btn-red">Hacer cita</a>
        </div>
      </div>
      <div class="col-xs-12">
        <hr/>
      </div>
    @endforeach
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 text-center">
      {!! $enterprises->appends($params)->render() !!}
    </div>
  </div>
</div>
@endsection