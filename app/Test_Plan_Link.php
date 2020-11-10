<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Test_Plan_Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_verificador', 'enlace'
    ];

    public static function getPlanLink($id)
    {
        $enlace_plan = DB::table('test__plan__links')->find($id);

        return $enlace_plan;
    }
}
