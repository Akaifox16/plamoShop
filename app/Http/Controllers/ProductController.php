<?php

namespace App\Http\Controllers;

use App\Http\Requests\productReq;
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

    public function create(productReq $req){
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
        $count = products::get()->count();
        if($count>1){
            $del = products::find($id);
            $cid = $del->product->productNumber;
            $del->delete();
            $productCode = products::where('productCode',$cid)->get();
            $i = 1;
            foreach($productCode as $prd){
                DB::table('products')
                ->where('productCode',$cid)
                ->update([
                    "productCode" => $i
                ]);
                $i++;
        }
        return response(['data'=>$del],200);
    }

    return response(['error'=>"productCode required"],204);
    }

}
