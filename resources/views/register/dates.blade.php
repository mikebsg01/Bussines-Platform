@extends('layouts.register')
@section('title', 'Fechas para citas | AEM')
@section('specific-height', 'data-adaptable-style="true" data-style="min-height:99.9"')
@section('body-classes', 'bg-register')
@section('content-classes', 'overflow-hidden')
@section('content')
<div class="space-30px"></div>
<div class="container-fluid">
  <div class="row">
    <div class="register-container">
      <div class="register-form">
        {{ Form::open(['route' => 'register.dates.store', 'method' => 'POST', 'id' => 'register_form']) }}
          <div class="col-xs-12">
            <div class="col-xs-12 col-sm-12 col-md-6" id="pop-cites" data-element="popover" data-show="true" title="Importante" data-content="Para un mayor rendimiento de la plataforma es recomendable
                  elegir al menos 3 días de la semana para recibir citas.">
              <div class="col-xs-12">
                <h1 class="special-title-2 padding"> ELIJA LAS FECHAS PARA RECIBIR MÁS CITAS: </h1>
              </div>
              @if ($errors->has('empty_schedule'))
                <div class="col-xs-11 col-xs-offset-1 no-padding">
                  <span class="help-block">
                    <strong>{{ $errors->first('empty_schedule') }}</strong>
                  </span>
                </div>
              @endif
              <div class="col-xs-11 col-xs-offset-1 no-padding">
                <div class="col-xs-9 col-xs-offset-3">
                  <h3 class="text-center th-1"> HORAS: </h3>
                </div>
              </div>
              <?php 
                $item_index = 0;
              ?>
              @foreach( getDaysOfTheWeek() as $item => $day )
                <?php 
                    $isset_fields = (!empty($fields) && $errors->count() > 0) && array_key_exists($item, $fields);

                    if (!$isset_fields && !is_null($schedule))
                    {
                      $fields = $schedule;
                      $isset_fields = array_key_exists($item, $fields);
                    }
                ?>
                <div id="{{ 'inputs-container-' . $item_index  }}">
                  @for ($i = 0; $i < 1 || ($isset_fields && $i < count($fields[$item]));  ++$i) 
                    <div id="inputs-{{ $item }}-{{ $i }}">
                      <div class="col-xs-11 col-xs-offset-1 no-padding margin-bottom-15px">
                        @if ($i == 0)
                          <div class="col-xs-3 no-padding">
                            <h3 class="thr-1"> {{ cstrtoupper($day) }} </h3>  
                          </div>
                          <div class="col-xs-1 no-padding">

                            @if ($isset_fields || $errors->has('day.'.$item.'.'.$i.'.from') || $errors->has('day.'.$item.'.'.$i.'.to') )
                              <button id="{{ $item }}-switch" class="btn btn-link btn-invert-red" data-role="switch" data-enable="#{{ $item.'_'.$i }}_from,#{{ $item.'_'.$i }}_to" data-enabled="true">
                                <span class="fa fa-unlock register-icon-unlock"></span>
                              </button>
                            @else
                              <button id="{{ $item }}-switch" class="btn btn-link btn-invert-red" data-role="switch" data-enabled="false">
                                <span class="fa fa-lock register-icon-unlock"></span>
                              </button>
                            @endif

                          </div>
                        @endif
                        <div class="col-xs-3 {{ ($i > 0) ? 'col-xs-offset-4' : '' }} no-padding">
                          {{ Form::text('day['. $item .']['.$i.'][from]', isset($fields[$item][$i]) ? $fields[$item][$i]['from'] : null, ['id' => $item.'_'.$i.'_from', 'class' => 'day-'.$item.'-from form-control text-center datetimepicker-time' . ($errors->has('day.'.$item.'.'.$i.'.from') ? ' has-error' : ''), 'data-switch' => $item.'-switch', 'placeholder' => '--:-- --', 'required' => 'required']) }}
                        </div>
                        <div class="col-xs-1">
                          <p class="text-center">A</p>
                        </div>
                        <div class="col-xs-3 no-padding">
                          {{ Form::text('day['. $item .']['.$i.'][to]', isset($fields[$item][$i]) ? $fields[$item][$i]['to'] : null, ['id' => $item.'_'.$i.'_to', 'class' => 'day-'.$item.'-to form-control text-center datetimepicker-time' . ($errors->has('day.'.$item.'.'.$i.'.to') ? ' has-error' : ''), 'data-switch' => $item.'-switch', 'placeholder' => '--:-- --', 'required' => 'required']) }}
                        </div>
                        <div class="col-xs-1 no-padding">
                          @if ($i == 0)
                            <button id="add-element-{{ $item }}" class="btn btn-link btn-invert-red app-add-element" data-container="#{{ 'inputs-container-' . $item_index  }}" data-item="{{ $item }}" data-switch="{{ $item }}-switch">
                              <span class="glyphicon glyphicon-plus"></span>
                            </button>
                          @else 
                            <button data-delete="#inputs-{{ $item }}-{{ $i }}" class="app-delete-element delete-element-{{ $item }} btn btn-link btn-invert-red" data-switch="{{ $item }}-switch">
                              <span class="glyphicon glyphicon-trash"></span>
                            </button>
                          @endif 
                        </div>
                      </div>
                      @if ( $errors->has('day.'.$item.'.'.$i.'.from') || $errors->has('day.'.$item.'.'.$i.'.to') )
                        <div class="col-xs-8 col-xs-offset-1 no-padding margin-bottom-15px">

                          @if ($errors->has('day.'.$item.'.'.$i.'.from'))
                          <span class="help-block">
                            <strong>{{ $errors->first('day.'.$item.'.'.$i.'.from') }}</strong>
                          </span>
                          @endif

                          @if ($errors->has('day.'.$item.'.'.$i.'.to'))
                          <span class="help-block">
                            <strong>{{ $errors->first('day.'.$item.'.'.$i.'.to') }}</strong>
                          </span>
                          @endif

                        </div>
                      @endif
                    </div>
                  @endfor
                </div>
                <?php 
                  ++$item_index; 
                ?>
              @endforeach
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
<div class="space-20px"></div>
@endsection