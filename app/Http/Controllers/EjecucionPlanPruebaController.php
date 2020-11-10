<?php

namespace App\Http\Controllers;

use App\Level_Activities_Result;
use App\Order_Test_Level;
use App\Test_Execution;
use App\Test_Level;
use App\Test_Plan;
use App\Test_Plan_Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EjecucionPlanPruebaController extends Controller
{
    public function index($id, $codigo_verificador)
    {
        $plan_prueba = Test_Plan::getPlan($id);
        $retorno_enlace = Test_Plan_Link::getPlanLink($plan_prueba->id_enlace_acceso);

        if(strcmp($retorno_enlace->codigo_verificador , $codigo_verificador) == 0)
        {
            return view('ejecucion_prueba.index', compact('plan_prueba'));
        }
        return view('ejecucion_prueba.url_invalida');
    }

    public function registrar_ejecutor(Request $request, $id_plan)
    {
        $request->validate([
            'nombre_usuario' => 'required|max:191',
            'correo' => 'required|max:191'
        ]);

        $retorno_ejecucion = Test_Execution::create([
            'id_test_plan' => $id_plan,
           'nombre_ejecutor' => $request->nombre_usuario,
           'email' => $request->correo
        ]);

        if($retorno_ejecucion){

            return redirect()->route('comenzar_ejecucion', ['id' => $retorno_ejecucion->id]);
        }
        return Redirect::back()->withErrors(['error' => 'No se pudo registrar en el plan de pruebas']);

    }

    public function comenzarEjecucion($id_ejecucion)
    {
        $ejecucion_plan =  Test_Execution::getTestExecution($id_ejecucion);
        $plan_pruebas = Test_Plan::getPlan($ejecucion_plan->id_test_plan);


        return view('ejecucion_prueba.ejecucion_plan_prueba')
            ->with(compact('ejecucion_plan'))
            ->with(compact('plan_pruebas'));
    }

    public function retornarVistaErrores($id_ejecucion)
    {
        return view('ejecucion_prueba.definicion_errores', compact('id_ejecucion'));
    }

    public function retornarVistaNiveles(Request $request, $id_ejecucion)
    {
        $ejecucion_plan =  Test_Execution::getTestExecution($id_ejecucion);
        $niveles_ordenados = Order_Test_Level::getCasosOrdenados($ejecucion_plan->id_test_plan);

        $request->session()->put('estado_niveles', $this->estadoCasosPruebas($ejecucion_plan->id_test_plan));

        return view('ejecucion_prueba.presentacion_niveles')
            ->with(compact('ejecucion_plan'))
            ->with(compact('niveles_ordenados'));
    }

    public function retornarVistaNivelAEjecutar(Request $request, $id_caso)
    {
        $caso_prueba = Test_Level::getTestLevel($id_caso);
        $actividades = Level_Activities_Result::getLevelActities($id_caso);

        return view('ejecucion_prueba.ejecucion_nivel')
            ->with(compact('caso_prueba'))
            ->with(compact('actividades'));
    }

    private function estadoCasosPruebas($id_plan)
    {
        $casos_de_prueba = Test_Level::getIdsTestPlanLevels($id_plan);
        $array_retorno = NULL;

        foreach ($casos_de_prueba as $caso)
        {
            $array_retorno[$caso->id] = FALSE;
        }

        return $array_retorno;
    }
}
