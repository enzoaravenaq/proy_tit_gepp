@extends('layouts.app_execution')

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">{{__('Niveles del Plan de Pruebas')}}</h5>
            <div class="card-body">
                <h5 class="card-title"> </h5>
                <p class="card-text">{{__('Bienvenido a la ejecución del plan de pruebas del proyecto "'.'"')}}</p>
                <div class="row">
                    @foreach($niveles_ordenados as $nivel)
                        <div class="col-sm">
                            <div class="card <?php echo(@session()->get('estado_niveles')[$nivel->id] === TRUE ? 'border-success' : 'border-secondary' ) ?>">
                                <div class="card-body">
                                    <h5 class="card-title">{{__('P'.$nivel->ident_caso.'-'.$nivel->nombre)}}</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    @if( $nivel->id_level_req !== NULL && @session()->get('estado_niveles')[$nivel->id_level_req] === FALSE )
                                        <a href="{{ route('ejecucion_nivel', $nivel->id) }}" class="btn btn-success disabled"> <i class="fas fa-lock"></i> {{__('Ir al nivel')}}</a>
                                        @elseif( $nivel->id_level_req !== NULL && @session()->get('estado_niveles')[$nivel->id_level_req] === TRUE )
                                            <a href="{{ route('ejecucion_nivel', $nivel->id) }}" class="btn btn-success"><i class="fas fa-chevron-circle-right"></i> {{__('Ir al nivel')}}</a>
                                        @else
                                            <a href="{{ route('ejecucion_nivel', $nivel->id) }}" class="btn btn-success"><i class="fas fa-chevron-circle-right"></i> {{__('Ir al nivel')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

