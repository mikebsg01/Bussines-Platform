@extends('layouts.app')
@section('title', 'Test | Payment Form')
@section('content')
<div class="space-50px"></div>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
      <div class="col-xs-4 col-xs-offset-4">
        <div class="col-xs-12">
          <div class="form-group">
            <h3 class="text-center"> Proceder al pago </h3>
          </div>
        </div>
        {{ Form::open(['method' => 'post', 'route' => 'test.payment.post']) }}
          <div class="col-xs-12">
            <div class="col-xs-6" style="padding:0">
              <div class="form-group">
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) }}
              </div>
            </div>
            <div class="col-xs-6" style="padding-right:0;">
              <div class="form-group">
                {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'lastname']) }}
              </div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              {{ Form::text('number', null, ['class' => 'form-control text-right', 'placeholder' => '18 digits']) }}
            </div>
            <div class="form-group">
              {{ Form::select('type', ['visa' => 'visa', 'mastercard' => 'mastercard', 'discover' => 'discover', 'amex' => 'amex'], null, ['class' => 'form-control text-right']) }}
            </div>
          </div>
          <div class="col-xs-12">
            <div class="col-xs-6" style="padding:0;">
              <div class="col-xs-5" style="padding:0;">
                {{ Form::text('month', null, ['class' => 'form-control text-right', 'placeholder' => 'mm']) }}
              </div>
              <div class="col-xs-2">
                <label class="text-center">/</label>
              </div>
              <div class="col-xs-5" style="padding-right:0;">
                {{ Form::text('year', null, ['class' => 'form-control text-right', 'placeholder' => 'yy']) }}
              </div>
            </div>
            <div class="col-xs-6" style="padding-right:0;">
              <div class="form-group">
                {{ Form::text('cvv2', null, ['class' => 'form-control text-right', 'placeholder' => '3 digits']) }}
              </div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group text-center">
              {{ Form::submit('Realizar pago', ['class' => 'btn btn-success btn-block']) }}
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
<div class="space-20px"></div>
@endsection