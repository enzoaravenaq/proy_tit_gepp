<?php

namespace App;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Order_Test_Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_test_plan', 'id_test_level', 'deleted'
    ];

    public static function numeroRegistrosValidos($id_plan)
    {
        return DB::table('order__test__levels')
            ->selectRaw('COUNT(id) as numero_registros')
            ->where('id_test_plan', $id_plan)
            ->whereNull('deleted')
            ->first();
    }

    public static function borrarOrdenCasosPrueba($id_plan)
    {
        $fecha = date('Y-m-d H:i:s');
        return DB::table('order__test__levels')
            ->where('id_test_plan', $id_plan)
            ->update([
                'deleted' => $fecha]);
    }

    public static function getCasosOrdenados($id_plan)
    {
        return DB::table('order__test__levels')
           ->join('test__levels', 'order__test__levels.id_test_level', '=', 'test__levels.id')
           ->select('test__levels.*')
           ->where('order__test__levels.id_test_plan', $id_plan)
           ->whereNull('order__test__levels.deleted')
           ->orderBy('order__test__levels.id', 'asc')
           ->get();
    }
}
