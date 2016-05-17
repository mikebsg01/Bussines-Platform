@extends('layouts.register')
@section('title', 'Haz finalizado | AEM')
@section('specific-height', 'data-adaptable-style="true" data-style="min-height:99.9"')
@section('body-classes', '')
@section('content-classes', 'overflow-hidden')
@section('content')
<div class="space-30px"></div>
<div class="container-fluid">
  <div class="row">
    <div class="register-container">
      <div class="register-form">
        <div class="col-xs-12 no-padding" data-adaptable-style="true" data-style="margin-top:30">
          <h1 class="text-center special-title-3"> ¡Haz finalizado tu registro! </h1>
          <div class="col-xs-12 no-padding text-center margin-top-15px">
            <a href="{{ route('register.complete') }}" class="special-link-3"> Ir a Perfil </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="space-20px"></div>
@endsection