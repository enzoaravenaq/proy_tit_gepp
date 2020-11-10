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
        @if(@session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{@session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(@session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{__('Error! ')}}</strong>{{@session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h2>{{ __('Mis Planes de Prueba') }}</h2></div>
                    <div class="col"></div>
                    <div class="col">
                        <a class="btn btn-primary" href="{{ route('crear_plan_prueba') }}" role="button"> <i class="fas fa-plus-circle"></i> {{ __('Crear plan de pruebas') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @if(isset($planes_de_prueba))
                        @foreach($planes_de_prueba as $key => $plan)
                            <div class="card mt-2 ml-2" style="width: 18rem;">
                                <img class="card-img-top" src="logos_plan_pruebas/<?php echo(isset($plan->nombre_imagen) ? $plan->nombre_imagen : 'default_logo.jpg')?>">
                                <div class="card-body">
                                    <h5 class="card-title"><b>{{ $plan->nombre_plan }}</b></h5>
                                    <p class="card-text">{{__('Proyecto: '). $plan->nombre_proyecto}} </p>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <a href="{{route('ver_plan_prueba', $plan->id)}}" class="btn btn-primary"> <i class="fas fa-eye"></i> {{__('Ir al plan de pruebas')}}</a>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal_{{$key}}">
                                                <i class="fas fa-trash"></i>
                                                {{__('Eliminar Plan')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{__('Eliminar Plan de Pruebas')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{__('¿Está seguro de que desea eliminar el Plan de Pruebas?')}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('borrar_plan_prueba', $plan->id) }}" class="btn btn-light"><i class="fas fa-check"></i> {{__('Sí')}}</a>
                                            <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-times"></i> {{__('No')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
