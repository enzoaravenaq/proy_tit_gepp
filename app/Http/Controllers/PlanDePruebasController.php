<?php

namespace App\Http\Controllers;

use App\Order_Test_Level;
use App\Test_Level;
use App\Test_Plan;
use App\Test_Plan_Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PlanDePruebasController extends Controller
{
    public function index()
    {
        $planes_de_prueba = Test_Plan::getMyPlans(auth()->id());

        return view('user.index', compact('planes_de_prueba'));
    }

    public function create()
    {
        return view('user.plan_pruebas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'test_name' => 'required|max:191',
            'project_name' => 'required|max:191',
            'project_icon' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $name_file = null;

        if($request->hasFile('project_icon'))
        {
            $file = $request->file('project_icon');
            $name_file = time().$file->getClientOriginalName();
            $file->move(public_path().'/logos_plan_pruebas/', $name_file);
        }

        $retorno_plan = Test_Plan::create([
            'id_usuario' => auth()->id(),
            'nombre_plan' => $request->test_name,
            'nombre_proyecto' => $request->project_name,
            'nombre_imagen' => $name_file
        ]);

        if($retorno_plan)
        {
            $codigo_verificador = time().'_'.$retorno_plan->id;
            $enlace = 'http://localhost/proy_tit_gepp/public/ejecucion_plan_pruebas/'.$retorno_plan->id.'/'.$codigo_verificador;

            $retorno_link = Test_Plan_Link::create([
                'codigo_verificador' => $codigo_verificador,
                'enlace' => $enlace
            ]);

            if($retorno_link)
            {
                Test_Plan::registrarIdEnlace($retorno_plan->id, $retorno_link->id);
            }
            return redirect()->route('index')
                ->with('success', 'Plan de pruebas creado satisfactoriamente.');
        }
        return redirect()->route('index')
            ->with('error', 'No se pudo crear el plan de pruebas.');
    }

    public function show($id)
    {
        $id_usuario = auth()->id();
        $plan_de_prueba = Test_Plan::getPlanUsuario($id, $id_usuario);

        if($plan_de_prueba)
        {
            $casos_de_prueba = Test_Level::getTestPlanLevels($id);
            $enlace_plan = Test_Plan_Link::getPlanLink($plan_de_prueba->id_enlace_acceso);

            return view('user.plan_pruebas.show_test_plan')
                ->with(compact('plan_de_prueba'))
                ->with(compact('casos_de_prueba'))
                ->with(compact('enlace_plan'));
        }
        return redirect()->route('index')
            ->with('error', 'No existe el plan de pruebas al cual quiere acceder');
    }

    public function edit($id)
    {
        $id_usuario = auth()->id();
        $plan_a_editar = Test_Plan::getPlanUsuario($id, $id_usuario);

        return view('user.plan_pruebas.edit')
            ->with(compact('plan_a_editar'))
            ->with(compact('id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'test_name' => 'required|max:191',
            'project_name' => 'required|max:191',
            'project_icon' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $name_file = null;

        if($request->hasFile('project_icon'))
        {
            $file = $request->file('project_icon');
            $name_file = time().$file->getClientOriginalName();
            $file->move(public_path().'/logos_plan_pruebas/', $name_file);

            if(Test_Plan::actualizarPlan($id, $request->test_name, $request->project_name, $name_file)){
                return redirect()->route('ver_plan_prueba', $id)
                    ->with('success', 'Plan de pruebas modificado satisfactoriamente.');
            }
            return redirect()->route('ver_plan_prueba', $id)
                ->with('error', 'Plan de pruebas no se pudo modificar.');
        }

        if(Test_Plan::actualizarPlanSinImagen($id, $request->test_name, $request->project_name)){
            return redirect()->route('ver_plan_prueba', $id)
                ->with('success', 'Plan de pruebas modificado satisfactoriamente.');
        }
        return redirect()->route('ver_plan_prueba', $id)
            ->with('error', 'Plan de pruebas no se pudo modificar.');
    }

    public function destroy($id)
    {
        $id_usuario = auth()->id();
        $test_plan = Test_Plan::getPlanUsuario($id, $id_usuario);

        if($test_plan)
        {
            $retorno_eliminacion = Test_Plan::eliminarTestPlan($id);
            if($retorno_eliminacion)
                return redirect()->route('index')
                    ->with('success', 'Plan de pruebas eliminado satisfactoriamente.');
            else
                return redirect()->route('index')
                    ->with('error', 'No se pudo eliminar el plan de pruebas');
        }
        return redirect()->route('index')
            ->with('error', 'No se pudo eliminar el plan de pruebas, debido a que no es un registro válido');
    }

    public function ordenarCasosPrueba($id_plan)
    {
        return view('user.plan_pruebas.order_test_levels', compact('id_plan'));
    }

    public function obtenerCasosDePrueba(Request $request, $id)
    {
        if($request->ajax()){
            $casos_de_prueba = Test_Level::getTestPlanLevels($id);
            if($casos_de_prueba->all())
                return response()->json($casos_de_prueba);
        }
        return;
    }

    public function guardarOrdenCasosDePrueba(Request $request, $id)
    {
        if($request->ajax()){

            $casos_de_prueba = $request->all();
            if($casos_de_prueba)
            {
                $numero_registros = Order_Test_Level::numeroRegistrosValidos($id);

                if($numero_registros->numero_registros > 0) {
                    if(! Order_Test_Level::borrarOrdenCasosPrueba($id)){
                        $request->session()->flash('error', 'No se pudo registar el orden de ejecución de los casos de prueba');
                        return response()->json([
                            'url' => 'http://localhost/proy_tit_gepp/public/user/plan_pruebas/'.$id.'/ver'
                        ]);
                    }
                }

                foreach ($casos_de_prueba as $caso)
                {
                    $retorno = Order_Test_Level::create([
                        'id_test_plan' => $id,
                        'id_test_level' => $caso['id'],
                    ]);

                    if(! $retorno){
                        $request->session()->flash('error', 'No se pudo registar el orden de ejecución de los casos de prueba');
                        return response()->json([
                            'url' => 'http://localhost/proy_tit_gepp/public/user/plan_pruebas/'.$id.'/ver'
                        ]);
                    }
                }
                $request->session()->flash('success', 'Se ha registrado el orden de ejecución de los casos de prueba.');
                return response()->json([
                    'url' => 'http://localhost/proy_tit_gepp/public/user/plan_pruebas/'.$id.'/ver'
                ]);
            }
        }
        $request->session()->flash('error', 'No se pudo registar el orden de ejecución de los casos de prueba');
        return response()->json([
            'url' => 'http://localhost/proy_tit_gepp/public/user/plan_pruebas/'.$id.'/ver'
        ]);
    }
}
