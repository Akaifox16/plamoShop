<?php

namespace App\Http\Controllers;
use App\Models\stock_in;
use App\Http\Requests\stockReq;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class stockController extends Controller
{
    public function get(){
        $stock = stock_in::all();
        return $stock;
    }
 
    public function create(stockReq $req){
        $validate = $req->validated();
        $timestamp = date('d-m-Y H:i:s');
        try{
            DB::table('stock_in')->insert([
                "productCode"=> $validate ['productCode'],
                "qty"=> $validate ['qty'],
                "created_at"=> $timestamp,
                "update_at"=> $timestamp          
            ]);
            DB::table('products')->update([
                "quantityInStocks" => + $validate ['quantityInStock']
            ]);
            
            return response(['success'=>true,'data'=>"Add the product successfully",'insert'=>$validate],201);
        }catch(Exception $e){
            return response(['success'=>false,'insert'=>"Missing requirement"],422);
        }
    } 


    public function count($count){
        $_count = stock_in::find($count)->stockcount->count()+1;
        return response(['no'=>$_count],200);
    }

    public function edit(stockReq $req,$productCode){
        $timestamp = date('d-m-Y H:i:s');
        if($req->accepts('application/json')){
            $validated = $req->validated();
            try{
                DB::table('stock_in')->where('productCode',$productCode)
                ->update([
                    'productCode'=> $validated['productCode'],
                    'qty' => $validated ['qty'],
                    'update_at'=> $timestamp
                ]);
                return response(['success'=>true,'data'=>$validated],200);
            }catch(Exception $e){
                return response(['success'=>false,'error'=>$e],204);
            }
        }
        return response(['success'=>false,'error'=>'[requied]content-type: json'],204);
    }

        
}
    

