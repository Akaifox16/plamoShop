<?php

namespace App\Http\Controllers;

use App\Models\stock_in;
use Illuminate\Http\Request;

class stockController extends Controller
{
    public function get($sid){
        
        $stock = stock_in::find($sid);
        
        return response($stock);
    }
    public function getstockin(){
        $stock = stock_in::all();
        return $stock;
    }

    //public function() 
}
