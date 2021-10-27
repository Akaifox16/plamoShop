<?php

namespace App\Http\Controllers;

use App\Http\Requests\productReq;
use App\Http\Requests\Reqproduct;
use App\Models\preorders;
use App\Models\products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getproductByID($id){
        $product = products::where('productCode',$id)
                    ->get();
    return response(['product'=>$product]);
    }

    public function create(Reqproduct $req){
        $validate = $req->validated();
        try{
            DB::table('products')->insert([
                'productCode'=> $validate['productCode'],
                'productName'=> $validate['productName'],
                'productLine'=> $validate['productLine'],
                'productScale'=> $validate['productScale'],
                'productVendor'=> $validate['productVendor'],
                'productDescription' => $validate['productDescription'],
                'quantityInStock' => $validate['quantityInStock'],
                'buyPrice' => $validate['buyPrice'],
                'MSRP'=> $validate['MSRP']
            ]);

            return response(['success'=>true,'data'=>"Add the product successfully",'insert'=>$validate],201);

        }catch(Exception $e){
            return response(['success'=>false,'data'=>"Missing requiremet"],422);
        }
    }

    public function edit(productReq $req,$productCode){
        if($req->accepts('application/json')){
            $validated = $req->validated();
            try{
                DB::table('products')->where('productCode',$productCode)
                ->update([
                    'productName'           => $validated['productName'],
                    'productScale'          => $validated['productScale'],
                    'productVendor'         => $validated['productVendor'],
                    'productDescription'    => $validated['productDescription'],
                    'quantityInStock'       => $validated['quantityInStock'],
                    'buyPrice'              => $validated['buyPrice'],
                    'MSRP'                  => $validated['MSRP']
                ]);

                return response(['success'=>true,'data'=>$validated],200);
            }catch(Exception $e){
                return response(['success'=>false,'error'=>$e],204);
            }
        }
        return response(['success'=>false,'error'=>'[required]content-type: json'],204);
    }

    public function del($id){
            $del = products::find($id);
            $del->delete();
        return response(['success'=> true ,'data'=>$id],200);
    }

}
