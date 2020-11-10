<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \DateTime;

class Level_Activities_Result extends Model
{
    protected $fillable = [
        'id_test_level', 'actividad', 'respuesta_sistema'
    ];

    public static function getLevelActities($id_level)
    {
        return DB::table('level__activities__results')
            ->select( 'id', 'actividad', 'respuesta_sistema')
            ->where([
                ['id_test_level', '=', $id_level],
                ['deleted', '=', NULL],
            ])->orderBy('id', 'asc')
            ->get();
    }

    public static function actualizarActividades($id_caso, $actividades){

        $fecha_actual = new DateTime();
        $fecha_actual->getTimestamp();
        $fecha_actual = $fecha_actual->format('Y-m-d H:i:s');

        $retorno_delete = DB::table('level__activities__results')
            ->where('id_test_level', $id_caso)
            ->update([
                'deleted' => $fecha_actual]);

        if($retorno_delete)
        {
            for($i=0; $i< count($actividades['act']); $i++)
            {
                if(!Level_Activities_Result::create([
                    'id_test_level' => $id_caso,
                    'actividad' => $actividades['act'][$i],
                    'respuesta_sistema' => $actividades['resp'][$i]
                ])){
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}
