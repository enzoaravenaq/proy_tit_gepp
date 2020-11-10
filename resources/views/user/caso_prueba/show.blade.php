@extends('layouts.app')

@section('navbar_content')
    <li class="nav-item" xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml"
        xmlns:v-on="http://www.w3.org/1999/xhtml">
        <a class="nav-link" href="{{route('index')}}">{{ __('Planes de Prueba') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">{{ __('Historial de Pruebas') }}</a>
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h2>{{ __('Caso de Prueba') }}</h2></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <dt class="col-sm-3">{{__('Identificador de la prueba: ')}}</dt>
                    <dd class="col-sm-4 text-left">{{__('P'.$caso_prueba->ident_caso)}}</dd>
                </div>
                <div class="row">
                    <dt class="col-sm-3">{{__('Nombre de la prueba: ')}}</dt>
                    <dd class="col-sm-4 text-left">{{__($caso_prueba->nombre)}}</dd>
                </div>
                <div class="row">
                    <dt class="col-sm-3">{{__('Actor(es): ')}}</dt>
                    <dd class="col-sm-4 text-left">{{__($caso_prueba->actores)}}</dd>
                </div>
                <div class="row">
                    <dt class="col-sm-3">{{__('Identificador requerimiento: ')}}</dt>
                    <dd class="col-sm-4 text-left">{{__($caso_prueba->ident_req)}}</dd>
                </div>
                <div class="row">
                    <dt class="col-sm-3">{{__('Pre-condición: ')}}</dt>
                    <dd class="col-sm-4 text-left"><?php echo($caso_prueba->id_level_req != NULL ? $mostrar : 'Ninguna' )?></dd>
                </div>
                <div class="row">
                    <dt class="col-sm-3">{{__('Descripción de la prueba: ')}}</dt>
                    <dd class="col-sm-4 text-left">{{__($caso_prueba->descripcion)}}</dd>
                </div>

                <?php $i=1;?>
                @foreach($actividades as $actividad)
                    <div class="card">
                        <div class="card-header ">
                            {{__('Actividad y Respuesta del Sistema #'. $i)}}
                        </div>
                        <div class="card-body text-left">
                            <div class="row">
                                <dt class="col-sm-3">{{__('Actividad: ')}}</dt>
                                <dd class="col-sm-4 text-left">{{__($actividad->actividad)}}</dd>
                            </div>
                            <div class="row">
                                <dt class="col-sm-3">{{__('Respuesta Sistema: ')}}</dt>
                                <dd class="col-sm-4 text-left">{{__($actividad->respuesta_sistema)}}</dd>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row mt-3">
                    <div class="col-12">
                        <a class="btn btn-danger" href="{{ route('ver_plan_prueba', $caso_prueba->id_test_plan) }}" role="button"><i class="far fa-times-circle"></i> {{ __('Volver') }}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
