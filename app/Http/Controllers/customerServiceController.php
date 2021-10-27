<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reqpoint;
use App\Models\customeraddresses;
use App\Models\customers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customerServiceController extends Controller
{
    public function points(Reqpoint $req){
        $validated = $req->validated();
        try{
            $id = $validated['customerNumber'];
            $customer = customers::find($id);
            if(!is_null($customer)){
                $point = $customer->points;
                $total_point = $point + $validated['points'];
                DB::table('customers')->where('customerNumber',$id)
                ->update([
                    'points' => $total_point
                ]);
                return response(["success" => true, "message" => "Point added",]);
            }
            return response(['success'=> false, 'data' => $validated],200);
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }

}
