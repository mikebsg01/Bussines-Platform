@extends('layouts.app')
@section('title', 'Inicio | AEM')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="col-xs-10 col-xs-offset-1">
        <h1 class="main-search-header text-center">
          Negocios efectivos a nivel nacional e internacional
        </h1>
        {!! Form::open(['route' => 'enterprise.search','method' => 'GET']) !!}
          <div class="input-group search-input-group main-search">
            {{ Form::text('q', isset($q) ? $q : "", ['class' => 'form-control text-center', 'placeholder' => 'Buscar empresa, producto o servicio...', 'focus']) }}
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default special-btn special-btn-red special-btn-small">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
