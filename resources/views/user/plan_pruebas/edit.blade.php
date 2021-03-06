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
        <div class="card text-center">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h2>{{ __('Editar Plan de Pruebas') }}</h2></div>
                </div>
            </div>
            <div class="card-body">
                <form action={{ route('actualizar_plan_prueba', $id) }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="test_name">Nombre plan de pruebas:</label>
                            <input id="test_name" name="test_name" type="text" class="form-control-sm" value="{{$plan_a_editar->nombre_plan}}">

                            @error('test_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="project_name">Nombre del proyecto:</label>
                            <input id="project_name" name="project_name" type="text" class="form-control-sm" value="{{$plan_a_editar->nombre_proyecto}}">

                            @error('project_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="project_icon">Logo del proyecto:</label>
                            <input type="file" class="form-control-file" id="project_icon" name="project_icon">

                            @error('project_icon')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button id="btn_submit" class="btn btn-primary" type="submit"> <i class="fas fa-save"></i> {{ __('Guardar') }}</button>
                            <a class="btn btn-danger" href="{{ route('ver_plan_prueba', $id) }}" role="button"> <i class="fas fa-times"></i> {{ __('Cancelar') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
