<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
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

    public function getnoQty(){
        $results = DB::select(DB::raw("
        SELECT  *
        FROM    products WHERE quantityInStock = 0
        "));
        return $results;
    }

}
