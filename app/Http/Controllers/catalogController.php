<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class catalogController extends Controller
{
    public function filter(){
        $results = DB::select(DB::raw("
        SELECT  *
        FROM    products
        "));
        return $results;
    }
}
