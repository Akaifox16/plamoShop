<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReqpreOrder;
use App\Models\preorders;
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
            return $customer;
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }
}
