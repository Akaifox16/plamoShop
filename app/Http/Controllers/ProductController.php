<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getproductByID($id){
        $product = products::where('productCode',$id)
                    ->get();
    return response(['product'=>$product]);
    }
}
