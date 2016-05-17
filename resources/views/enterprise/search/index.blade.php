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
        <b>Búsqueda:</b> 
        {!! $engineSearch->getParametersToString() !!}
        &nbsp;
        -
        &nbsp;
        <?php $pagination = $enterprises->toArray(); ?>
        @if ($pagination['total'] > 0) 
          <b>Página:</b>
          {{ $pagination['current_page'] }}
          de
          {{ $pagination['last_page'] }}
          &nbsp;
          -
          &nbsp;
        @endif
        <b>Resultados:</b>
        {!! $pagination['total'] !!}
      </p>
    </div>
    <div class="search-filters col-xs-12 no-padding">
      <form method="GET">
        <input type="hidden" name="q" value="{{ ( !empty($q) ? $q : null ) }}" />
        @foreach($engineSearch->getFilterNames() as $filterName)
          <div class="dropdown col-xs-3 no-padding">
            <button class="col-xs-12 btn btn-default dropdown-toggle special-title-4 fg-red" type="button" id="dropdown_menu_{{ $filterName }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              {{ trans('general.label.' . $filterName) }}
              <span class="caret"></span>
            </button>
            <ul class="col-xs-12 dropdown-menu" data-role="filter" data-name="sectors"  aria-labelledby="dropdownMenu1">
              <div class="dropdown-header col-xs-12">
                <div data-role="form-tools" data-href="#filter_{{ $filterName }}">
                  <h5 class="fg-red dropdown-options pull-right">
                    <!-- [mark all]
                    <a href="#" class="mark-all">
                      <span class="fa fa-thumb-tack"></span>
                      Marcar todos
                    </a>
                    /
                    -->
                    <a href="#" class="unmark-all">
                      <span class="fa fa-thumb-tack"></span>
                      Desmarcar todos
                    </a>
                  </h5>
                </div>
              </div>
              <div id="filter_{{ $filterName }}" class="dropdown-body col-xs-12 no-padding">
                <?php $i = 0; ?>
                @foreach ($engineSearch->getFilterOptions($filterName) as $key => $value)
                  @if ($i > 0)
                    <li>
                      @if ($filterName == "enterprise_status") 
                        <input id="{{ $filterName.'_'.$key }}" type="radio" name="{{ $engineSearch->getAlias($filterName).'[]' }}" value="{{ $value }}" data-role="input-radio" data-title="{{ trans('general.text.' . $value) }}" {{ $engineSearch->filterOptionIsChecked($filterName, $value) ? "checked" : "" }} />
                      @else 
                        <input id="{{ $filterName.'_'.$key }}" type="checkbox" name="{{ $engineSearch->getAlias($filterName).'[]' }}" value="{{ $value }}" data-role="input-radio" data-title="{{ $value }}" {{ $engineSearch->filterOptionIsChecked($filterName, $value) ? "checked" : "" }} />
                      @endif
                    </li>
                  @endif
                  <?php ++$i; ?>
                @endforeach
              </div>
              <div class="dropdown-footer col-xs-12 no-padding">
                <button class="btn special-btn special-btn-red special-btn-small pull-right">Aplicar filtro</button>
              </div>
            </ul>
          </div>
        @endforeach
      </form>
    </div>
  </div>
</div>
<div class="container-fluid main-space">
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
            <hgroup>
              <h2 class="special-title-8 inline-block">
                <a href="{{ route('enterprise.profile', ['slug' => $enterprise->slug]) }}">
                  {{ $enterprise->name }}
                </a>
                <a href="#">
                  @if ($enterprise->enterprise_status->status == 'verified')
                    <sup>
                      <span class="fa fa-check-circle" data-toggle="tooltip" data-placement="right" title="Empresa verificada"></span>
                    </sup>
                  @endif
                </a>
              </h2>
              <h3 class="data special-title-10 inline-block pull-right">
                <span class="fa fa-building"></span>
                {{ $enterprise->sector->name }}
              </h3>
            </hgroup>
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
      {!! $enterprises->appends($engineSearch->getParameters())->render() !!}
    </div>
  </div>
</div>
@endsection