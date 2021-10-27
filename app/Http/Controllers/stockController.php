<?php

namespace App\Http\Controllers;
use App\Models\stock_in;
use App\Http\Requests\stockReq;
use App\Models\products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

class stockController extends Controller
{
    public function get(){
        $stock = stock_in::get(
            [ 'productCode','qty',
            'created_at','update_at']);
        return $stock;
    }
    public function getstock(){
        $results = DB::select(DB::raw("
        SELECT  *
        FROM    stock_in
        "));
        return $results;
    }
    public function getstockByID($id)
    {
        $stock = stock_in::where('productCode',$id)->get(
            [ 'qty',
            'created_at','updated_at']);
        return response(['stock'=> $stock]);
    }
 
    public function create(stockReq $req){
        $validate = $req->validated();
        try{
            $id = $validate['productCode'];
            $stock = new stock_in();
            $stock->qty = $validate['qty'];
            $stock->productCode = $id;
            $stock->save();

            $product = products::where('productCode',$id);
            if(!isNull($product)){
                $total = $product->quantityInStocks + $validate['qty'];
                products::where('productCode',$id)->update([
                    "quantityInStocks" => $total
                ]);
            }
            
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
    

