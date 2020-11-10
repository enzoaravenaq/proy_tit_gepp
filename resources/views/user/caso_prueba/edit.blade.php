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
                    <div class="col"><h2>{{ __('Editar Caso de Prueba') }}</h2></div>
                </div>
            </div>
            <div class="card-body">
                <form action={{ route('actualizar_caso_prueba', [$caso_prueba->id, $id_plan]) }} method="POST" >
                    @csrf
                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <div class="input-group input-group-sm">
                                <label for="level_id">{{__('Identificador de la prueba:')}}</label>
                                <div class="input-group-prepend ml-1">
                                    <span class="input-group-text form-control-sm" id="addon_level_id"><b>{{__('P')}}</b></span>
                                </div>
                                <input id="level_id" name="level_id" type="number" min="0" class="form-control-sm" aria-describedby="addon_level_id"
                                       value="{{$caso_prueba->ident_caso}}">
                            </div>

                            @error('level_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_name">{{__('Nombre de la prueba:')}} </label>
                            <input id="level_name" name="level_name" type="text" class="form-control-sm" value="{{$caso_prueba->nombre}}">

                            @error('level_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_actors">{{__('Actor(es):')}} </label>
                            <input id="level_actors" name="level_actors" type="text" class="form-control-sm" value="{{$caso_prueba->actores}}">

                            @error('level_actors')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_sist_req">{{__('Identificador requerimiento:')}}  </label>
                            <input id="level_sist_req" name="level_sist_req" type="text" class="form-control-sm" value="{{$caso_prueba->ident_req}}">

                            @error('level_sist_req')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_pre_condition">{{__('Pre-condición:')}} </label>
                            @if(isset($select_casos))
                                <select class="custom-select-sm form-control-sm" id="level_pre_condition" name="level_pre_condition">
                                    @foreach($select_casos as $caso)
                                        @if(isset($caso_prueba->id_level_req) && $caso->id === $caso_prueba->id_level_req)
                                            <option selected value="{{$caso->id}}">{{$caso->nombre_en_select}}</option>
                                            @elseif( !isset($caso_prueba->id_level_req) && $caso->id === -1)
                                                <option selected value="{{$caso->id}}">{{$caso->nombre_en_select}}</option>
                                            @else
                                                <option value="{{$caso->id}}">{{$caso->nombre_en_select}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                    @else
                                        <select class="custom-select-sm form-control-sm" id="level_pre_condition" name="level_pre_condition">
                                            <option selected value="-1">No hay casos de prueba</option>
                                        </select>
                            @endif
                            @error('level_pre_condition')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_description">{{__('Descripción de la prueba:')}} </label>
                            <textarea id="level_description" name="level_description" class="form-control"> {{$caso_prueba->descripcion}} </textarea>

                            @error('level_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <activity-result-edit-form-component v-bind:id_caso='{!! $id !!}'></activity-result-edit-form-component>


                    <div class="form-group row">
                        <div class="col-12">
                            <button id="btn_submit" class="btn btn-primary" type="submit"> <i class="fas fa-save"></i> {{ __('Guardar') }}</button>
                            <a class="btn btn-danger" href="{{ route('ver_plan_prueba', $id_plan) }}" role="button"><i class="far fa-times-circle"></i> {{ __('Cancelar') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection