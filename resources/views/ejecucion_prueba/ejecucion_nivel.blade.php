@extends('layouts.app_execution')

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">{{__('Nivel P'.$caso_prueba->ident_caso.'-'.$caso_prueba->nombre)}}</h5>
            <div class="card-body">
                <div class="row">
                    <dt class="col-sm-3">{{__('Descripción de la prueba')}}</dt>
                    <dd class="col-sm-9">{{__($caso_prueba->descripcion)}}</dd>

                    <dt class="col-sm-3">{{__('Rol(es) ejecutor de la prueba')}}</dt>
                    <dd class="col-sm-9">
                        <p>{{__($caso_prueba->actores)}}</p>
                    </dd>
                </div>

                <form action="{{ route('guardar_ejecucion_nivel') }}" method="POST">
                    @csrf
                    <div class="row">
                        <level-execution-component v-bind:id_caso='{!! $caso_prueba->id !!}' ></level-execution-component>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
