<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Test_Level extends Model
{
    protected $fillable = [
        'id_test_plan', 'id_level_req','ident_caso', 'nombre', 'descripcion', 'actores','ident_req',
    ];

    public static function getSelectPlanLevels($id_plan)
    {
        $casos_prueba = DB::table('test__levels')
            ->selectRaw( 'id, CONCAT("P", ident_caso, "-", nombre) as nombre_en_select')
            ->where([
            ['id_test_plan', '=', $id_plan],
            ['deleted', '=', NULL],
        ])->get();

        $obj = new \stdClass();
        $obj->id = -1;
        $obj->nombre_en_select = 'Seleccione un caso de prueba';

        $casos_prueba[] = $obj;

        return $casos_prueba;
    }

    public static function getTestPlanLevels($id_plan)
    {
        $casos_prueba = DB::table('test__levels')
            ->select( 'id', 'ident_caso', 'nombre', 'descripcion')
            ->where([
                ['id_test_plan', '=', $id_plan],
                ['deleted', '=', NULL],
            ])->get();


        return $casos_prueba;
    }

    public static function getTestLevel($id_level)
    {
        $caso_prueba = DB::table('test__levels')
            ->where([
                ['id', '=', $id_level],
                ['deleted', '=', NULL],
            ])->first();

        return $caso_prueba;
    }

    public static function actualizarCasoPrueba($id, $level_pre_condition, $level_id, $level_name, $level_descrip, $level_actors, $level_sist_req) :void
    {
        DB::table('test__levels')
            ->where('id', $id)
            ->update([
                'id_level_req' => $level_pre_condition,
                'ident_caso' => $level_id,
                'nombre' => $level_name,
                'descripcion' => $level_descrip,
                'actores' => $level_actors,
                'ident_req' => $level_sist_req]);
    }

    public static function getIdsTestPlanLevels($id_plan)
    {
        $casos_prueba = DB::table('test__levels')
            ->select( 'id')
            ->where([
                ['id_test_plan', '=', $id_plan],
                ['deleted', '=', NULL],
            ])->get();

        return $casos_prueba;
    }
    public static function eliminarTestLevel($id_level)
    {
        $fecha = date('Y-m-d H:i:s');

        self::eliminarTestLeveLEnReqs($id_level);

        return DB::table('test__levels')
            ->where('id', $id_level)
            ->update([
                'deleted' => $fecha]);
    }

    public static function eliminarTestLeveLEnReqs($id_level): void
    {
        DB::table('test__levels')
            ->where('id_level_req', $id_level)
            ->update([
                'id_level_req' => NULL]);
    }

    public static function getIdentYNombrePreCondicion($id_level)
    {
        $datos= DB::table('test__levels')
            ->select( 'ident_caso', 'nombre')
            ->where([
                ['id', '=', $id_level],
                ['deleted', '=', NULL],
            ])->first();

        return $datos;
    }
}
