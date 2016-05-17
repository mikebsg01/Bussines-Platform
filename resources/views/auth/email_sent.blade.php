@extends('layouts.app')
@section('title', 'Correo de confirmación | AEM')
@section('specific-height', 'data-adaptable-style="true" data-style="min-height:99.9"')
@section('body-classes', 'bg-register')
@section('content-classes', 'overflow-hidden')
@section('content')
<div class="space-30px"></div>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="special-margin-1 panel panel-default">
          <div class="panel-heading">
            <h3><span class="fa fa-check"></span> Confirma tu correo electrónico</h3>
          </div>
          <div class="panel-body">
            <p> 
              Se ha enviado un mensaje de confirmación a tu correo: <b>{{ $email }}</b>.<br/>
              Por favor, verifica tu bandeja de entrada.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="space-20px"></div>
@endsection