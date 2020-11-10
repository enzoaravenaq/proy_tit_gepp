<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Test_Execution extends Model
{
    protected $fillable = [
        'id_test_plan', 'nombre_ejecutor', 'email'
    ];

    public static function getTestExecution($id)
    {
        return DB::table('test__executions')->find($id);
    }
}
