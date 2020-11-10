@extends('layouts.app_execution')

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">{{__('¿Qué es un error del software?')}}</h5>
            <div class="card-body">
                <h5 class="card-title"> </h5>
                <p class="card-text">{{__('Bienvenido a la ejecución del plan de pruebas del proyecto "'.'"')}}</p>
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col">
                        <a href="{{route('niveles_ejecucion', $id_ejecucion)}}" class="btn btn-success"> {{__('Siguiente')}} <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

