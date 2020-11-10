@extends('layouts.app_execution')

@section('head')
@endsection

@section('content')
   @if(@session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>{{__('Error! ')}}</strong>{{@session('error')}}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
   @endif

   <div class="container">
      <div class="row mt-5">
         <div class="col"></div>
         <div class="col">
            <div class="card border-info mb-3" style="max-width: 25rem;">
               <div class="card-header"><h3>{{__('¡Bienvenido!')}}</h3></div>
               <div class="card-body">
                  <h5 class="card-title">{{__('Bienvenido al plan de pruebas "'.$plan_prueba->nombre_plan.'" del proyecto "'. $plan_prueba->nombre_proyecto.'"' )}}</h5>
                  <p >{{__('Por favor ingrese un nombre de usuario y correo valido para ingresar al plan de pruebas.')}}</p>

                  <form action={{ route('registro_ejecutor', $plan_prueba->id) }} method="POST">
                     @csrf
                     <div class="form-group row">
                        <div class="col-sm">
                           <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre de usuario">

                           @error('nombre_usuario')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm">
                           <input type="text" name="correo" class="form-control" placeholder="Correo electrónico">

                           @error('correo')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group row text-right mt-3">
                        <div class="col-12">
                           <button id="btn_submit" class="btn btn-primary" type="submit"> <i class="fas fa-sign-in-alt"></i> {{ __('Ingresar') }}</button>
                        </div>
                     </div>
                  </form>

               </div>
            </div>
         </div>
         <div class="col"></div>
      </div>
   </div>
<div class="container text-center">

</div>


@endsection