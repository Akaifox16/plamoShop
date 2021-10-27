<?php

namespace App\Http\Controllers;

use App\Models\productlines;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class catalogController extends Controller
{
    public function filter(){
        $results = products::all();
        return $results;
    }

    public function getImg($type){
        $res = productlines::where('productLine',$type)
        ->get(['image']);
        return response($res);
    }
}
