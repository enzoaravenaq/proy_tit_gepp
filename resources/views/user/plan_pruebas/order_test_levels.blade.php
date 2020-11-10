@extends('layouts.app')

@section('navbar_content')
    <li class="nav-item">
        <a class="nav-link" href="{{route('index')}}">{{ __('Planes de Prueba') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">{{ __('Historial de Pruebas') }}</a>
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm"><h2>{{ __('Ordenar Casos de Prueba para Ejecución') }}</h2></div>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md">
                            <p> A continuación, usted podra ordenar los casos de prueba según el orden que estime deba ejecutarlos un tester.
                                Para este orden se aplican las opciones de arrastrar y soltar.</p>
                        </div>
                    </div>
                    <div class="row">

                        <order-test-levels-component v-bind:id_plan='{!! $id_plan !!}'></order-test-levels-component>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection