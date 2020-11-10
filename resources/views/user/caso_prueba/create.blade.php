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
                    <div class="col"><h2>{{ __('Nuevo Caso de Prueba') }}</h2></div>
                </div>
            </div>
            <div class="card-body">
                <form action={{ route('guardar_caso_prueba', $id) }} method="POST" >
                    @csrf
                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <div class="input-group input-group-sm">
                                <label for="level_id">Identificador de la prueba:</label>
                                <div class="input-group-prepend ml-1">
                                    <span class="input-group-text form-control-sm" id="addon_level_id"><b>P</b></span>
                                </div>
                                <input id="level_id" name="level_id" type="number" min="0" class="form-control-sm" aria-describedby="addon_level_id">
                            </div>

                            @error('level_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_name">Nombre de la prueba: </label>
                            <input id="level_name" name="level_name" type="text" class="form-control-sm">

                            @error('level_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_actors">Actores: </label>
                            <input id="level_actors" name="level_actors" type="text" class="form-control-sm">

                            @error('level_actors')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_sist_req">Identificador requerimiento:  </label>
                            <input id="level_sist_req" name="level_sist_req" type="text" class="form-control-sm">

                            @error('level_sist_req')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row text-left">
                        <div class="col-sm">
                            <label for="level_pre_condition">Pre-condición: </label>
                            @if(isset($select_casos))
                            <select class="custom-select-sm form-control-sm" id="level_pre_condition" name="level_pre_condition">
                                @foreach($select_casos as $caso)
                                    <option <?php echo($caso->id === -1 ? 'selected ' : '')?> value="{{__ ($caso->id)}}">{{$caso->nombre_en_select}}</option>
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
                            <label for="level_description">Descripción de la prueba: </label>
                            <textarea id="level_description" name="level_description" class="form-control"></textarea>

                            @error('level_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <activity-result-form-component></activity-result-form-component>


                    <div class="form-group row">
                        <div class="col-12">
                            <button id="btn_submit" class="btn btn-primary" type="submit"> <i class="fas fa-save"></i> {{ __('Crear') }}</button>
                            <a class="btn btn-danger" href="{{ route('ver_plan_prueba', $id) }}" role="button"><i class="far fa-times-circle"></i> {{ __('Cancelar') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    import ActivityResultFormComponent from "../../../js/components/ActivityResultFormComponent";
    export default {
        components: {ActivityResultFormComponent}
    }
</script>