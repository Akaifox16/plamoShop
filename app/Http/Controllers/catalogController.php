<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class catalogController extends Controller
{
    public function fillter(){
        $results = DB::select(DB::raw("
        SELECT  *
        FROM    products
        "));
        return $results;
    }
}
