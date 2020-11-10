<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Test_Plan extends Model
{
    protected $fillable = [
        'id_usuario', 'id_enlace_acceso', 'nombre_plan', 'nombre_proyecto', 'nombre_imagen',
    ];

    public static function getMyPlans($id_usuario)
    {
        $planes_de_prueba = DB::table('test__plans')
            ->where([
            ['id_usuario', '=', $id_usuario],
            ['deleted', '=', NULL],
        ])->get();


        return $planes_de_prueba;
    }

    public static function getPlanUsuario($id_plan, $id_usuario)
    {
        $plan_de_prueba = DB::table('test__plans')
            ->where([
                ['id', '=', $id_plan],
                ['id_usuario', '=', $id_usuario],
                ['deleted', '=', NULL],
            ])->first();

        return $plan_de_prueba;
    }

    public static function getPlan($id_plan)
    {
        $plan_de_prueba = DB::table('test__plans')
            ->where([
                ['id', '=', $id_plan],
                ['deleted', '=', NULL],
            ])->first();

        return $plan_de_prueba;
    }

    public static function actualizarPlan($id_plan, $nombre_plan, $nombre_proyecto, $nombre_arch)
    {
        return DB::table('test__plans')
            ->where('id', $id_plan)
            ->update([
                'nombre_plan' => $nombre_plan,
                'nombre_proyecto' => $nombre_proyecto,
                'nombre_imagen' => $nombre_arch]);
    }

    public static function actualizarPlanSinImagen($id_plan, $nombre_plan, $nombre_proyecto)
    {
        return DB::table('test__plans')
            ->where('id', $id_plan)
            ->update([
                'nombre_plan' => $nombre_plan,
                'nombre_proyecto' => $nombre_proyecto]);
    }

    public static function registrarIdEnlace($id_plan, $id_enlace)
    {
        return DB::table('test__plans')
            ->where('id', $id_plan)
            ->update([
                'id_enlace_acceso' => $id_enlace]);
    }

    public static function eliminarTestPlan($id_plan)
    {
        $fecha = date('Y-m-d H:i:s');

        return DB::table('test__plans')
            ->where('id', $id_plan)
            ->update([
                'deleted' => $fecha]);
    }
}
