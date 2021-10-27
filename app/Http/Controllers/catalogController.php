<?php

namespace App\Http\Controllers;

use App\Models\productlines;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class catalogController extends Controller
{
    public function filter(){
        $results = DB::table('products')->get();
        return $results;
    }


    public function getImg($type){
        $res = productlines::where('productLine',$type)
        ->get(['image']);
        return response($res);
    }

    public function getnoQty(){
        $results = DB::select(DB::raw("
        SELECT  *
        FROM    products WHERE quantityInStock = 0
        "));
        return $results;
    }

}
