<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReqdetailpreOrder;
use App\Http\Requests\ReqpreOrder;
use App\Models\preorders;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreOrderController extends Controller
{
    public function getPreOrder(ReqpreOrder $req){
        $validated = $req->validated();
        try{
            $cusID = $validated['customerNumber'];
            $customer = DB::table('preorders')
                        ->where('customerNumber',$cusID)
                        ->get();
            return response(['preorder'=>$customer]);
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }

    public function createPreOrder(ReqdetailpreOrder $req){
        $validated = $req->validated();
        try{
            preorders::insert([
                'orderDate' => now(),
                'customerNumber' => $validated['customerNumber'],
                'productCode' => $validated['productCode'],
                'preorderQuantity' => $validated['preorderQuantity']
            ]);
            return response(["success" => true, "message" => "add successful"]);
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }

    public function create(Request $request, $id){
        DB::table('preorders')->insert([ 
            'orderDate' => Carbon::now()->toDate(),
            'customerNumber' => $id,
            'productCode' => $request->input('productCode'),
            'preorderQuantity' => $request->input('preorderQuantity')
        ]);
        return response($request->input('preorder'));
    }


    public function getLast(){
        $preorder = DB::table('preorders')->get()->last();
        return response(['preorders'=>$preorder]);
    }

}
