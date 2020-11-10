<?php

namespace App\Http\Controllers;
use App\Test_Plan;
use Illuminate\Http\Request;
use App\Test_Level;
use App\Level_Activities_Result;

class CasoDePruebaController extends Controller
{

    public function index()
    {
        //
    }

    public function create($id)
    {
        $select_casos = Test_Level::getSelectPlanLevels($id);
        return view('user.caso_prueba.create')
            ->with(compact('select_casos'))
            ->with(compact( 'id'));
    }

    public function store(Request $request, $id_plan)
    {
        $request->validate([
           'level_id' => 'required|numeric|min:0',
           'level_name' => 'required|max:191',
           'level_description' => 'required|max:191',
           'level_actors' => 'required|max:191',
           'level_sist_req' => 'required|max:191'
        ]);

        if($this->validarActividades($request->actividades))
        {
            if($request->level_pre_condition == -1)
                $request->level_pre_condition = NULL;

            $retorno_level = Test_Level::create([
                'id_test_plan' => $id_plan,
                'id_level_req' => $request->level_pre_condition,
                'ident_caso' => $request->level_id,
                'nombre' => $request->level_name,
                'descripcion' => $request->level_description,
                'actores' => $request->level_actors,
                'ident_req' => $request->level_sist_req
            ]);

            if($retorno_level)
            {
                $array_actividades = $request->actividades;
                for($i=0; $i< count($request->actividades['act']); $i++)
                {
                    if(!Level_Activities_Result::create([
                        'id_test_level' => $retorno_level->id,
                        'actividad' => $array_actividades['act'][$i],
                        'respuesta_sistema' => $array_actividades['resp'][$i]
                    ])){
                        return redirect()->route('ver_plan_prueba', $id_plan)
                            ->with('error', 'Hubo problemas al registrar actividades y respuestas del caso de prueba');
                    }
                }
                return redirect()->route('ver_plan_prueba', $id_plan)
                    ->with('success', 'Caso de prueba creado satisfactoriamente');
            }else{
                return redirect()->route('ver_plan_prueba', $id_plan)
                    ->with('error', 'No se pudo crear el caso de pruebas');
            }
        }
        return redirect()->route('ver_plan_prueba', $id_plan)
            ->with('error', 'No se pudo crear el caso de pruebas debido a que un campo de actividad y respuesta estaba vacío');
    }


    public function show($id)
    {
        $caso_prueba = Test_Level::getTestLevel($id);

        if($caso_prueba)
        {
            $actividades = Level_Activities_Result::getLevelActities($id);

            $datos_pre_condicion = NULL;
            $mostrar = NULL;

            if($caso_prueba->id_level_req != NULL)
            {
                $datos_pre_condicion = Test_Level::getIdentYNombrePreCondicion($caso_prueba->id_level_req);
                if($datos_pre_condicion)
                {
                    $mostrar = 'P'.$datos_pre_condicion->ident_caso.'-'.$datos_pre_condicion->nombre;
                }
            }

            return view('user.caso_prueba.show')
                ->with(compact('caso_prueba'))
                ->with(compact('mostrar'))
                ->with(compact('actividades'));
        }
        return redirect()->back()->with('error', 'El caso de prueba al que desea ingresar no existe o no es valido.');
    }


    public function edit($id, $id_plan)
    {
        $caso_prueba = Test_Level::getTestLevel($id);
        $select_casos = Test_Level::getSelectPlanLevels($id_plan);

        return view('user.caso_prueba.edit')
            ->with(compact('caso_prueba'))
            ->with(compact('select_casos'))
            ->with(compact('id'))
            ->with(compact('id_plan'));
    }

    public function update(Request $request, $id, $id_plan)
    {
        $request->validate([
            'level_id' => 'required|numeric|min:0',
            'level_name' => 'required|max:191',
            'level_description' => 'required|max:191',
            'level_actors' => 'required|max:191',
            'level_sist_req' => 'required|max:191'
        ]);

        if($this->validarActividades($request->actividades))
        {
            if(Level_Activities_Result::actualizarActividades($id, $request->actividades))
            {
                if($request->level_pre_condition == -1)
                    $request->level_pre_condition = NULL;

                Test_Level::actualizarCasoPrueba($id, $request->level_pre_condition, $request->level_id, $request->level_name, $request->level_description, $request->level_actors, $request->level_sist_req);

                return redirect()->route('ver_plan_prueba', $id_plan)
                    ->with('success', 'Caso de prueba modificado satisfactoriamente.');
            }
            return redirect()->route('ver_plan_prueba', $id_plan)
                ->with('error', 'No se pudo modificar el caso de prueba.');
        }
        return redirect()->route('ver_plan_prueba', $id_plan)
            ->with('error', 'No se pudo modificar el caso de pruebas debido a que un campo de actividad y respuesta estaba vacío.');
    }

    public function destroy($id)
    {
        $caso_prueba = Test_Level::getTestLevel($id);

        if($caso_prueba)
        {
            $retorno_eliminacion = Test_Level::eliminarTestLevel($id);
            if($retorno_eliminacion)
            {
                return redirect()->route('ver_plan_prueba', $caso_prueba->id_test_plan)
                    ->with('success', 'Caso de Prueba eliminado satisfactoriamente. Es posible que algún caso de prueba quedara sin pre-requisito');
            }
            return redirect()->route('ver_plan_prueba', $caso_prueba->id_test_plan)
                ->with('error', 'No se puedo eliminar el caso de prueba.');
        }
        return redirect()->route('ver_plan_prueba', $caso_prueba->id_test_plan)
            ->with('success', 'No existe el caso de prueba que deseas eliminar.');
    }

    private function validarActividades($actividades)
    {
        for($i=0; $i< count($actividades['act']); $i++)
        {
            if($actividades['act'][$i] === NULL || $actividades['resp'][$i] === NULL)
            {
                return false;
            }
        }
        return true;
    }
}
