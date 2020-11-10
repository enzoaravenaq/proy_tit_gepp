<?php

namespace App\Http\Controllers;

use App\Level_Activities_Result;
use Illuminate\Http\Request;

class ActividadRespuestaController extends Controller
{
    public function index(Request $request, $id)
    {
        if($request->ajax()){
            $actividades = Level_Activities_Result::getLevelActities($id);
            if( $actividades->all() )
                return response()->json($actividades);
            else
                return response()->json([
                    ['actividad' => '', 'respuesta_sistema' => '']
                ]);
        }
        return;
    }

    public function obtenerActRespNivel(Request $request, $id)
    {
        if($request->ajax()){
            $actividades = Level_Activities_Result::getLevelActities($id);
            if( $actividades->all() )
            {
                $i=1;
                foreach ($actividades as $act)
                {
                    $act->titulo = 'Actividad y Respuesta del Sistema #'.$i;
                    $i++;
                }

                return response()->json($actividades);
            }
            else
                return response()->json([
                    ['titulo'=> '', 'actividad' => '', 'respuesta_sistema' => '']
                ]);
        }
        return;
    }
}
