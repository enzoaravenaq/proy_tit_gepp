@extends('layouts.app_execution')

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">{{__('¡Bienvenido!')}}</h5>
            <div class="card-body">
                <h5 class="card-title"> </h5>
                <p class="card-text">{{__('Bienvenido a la ejecución del plan de pruebas del proyecto "'. $plan_pruebas->nombre_proyecto.'"')}}</p>
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col">
                        <a href="{{route('definicion_errores', $ejecucion_plan->id)}}" class="btn btn-success"> {{__('Siguiente')}} <i class="fas fa-chevron-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
