<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReqdetailpreOrder;
use App\Http\Requests\ReqpreOrder;
use App\Models\preorders;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Validated;
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

    public function create(ReqdetailpreOrder $req, $id){
        $validated = $req->validated();
        DB::table('preorders')->insert([ 
            'orderDate' => Carbon::now()->toDate(),
            'customerNumber' => $id,
            'productCode' => $validated['productCode'],
            'preorderQuantity' => $validated['preorderQuantity']
        ]);
        return response(['createPreorder'=>$validated]);
    }


    public function getLast(){
        $preorder = DB::table('preorders')->get()->last();
        return response(['preorders'=>$preorder]);
    }

}
