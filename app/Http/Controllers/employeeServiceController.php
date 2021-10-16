<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reqpromote;
use App\Models\customers;
use App\Models\employees;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class employeeServiceController extends Controller
{
    public function get(){
        $customers = customers::get(
            [ 'customerNumber','customerName',
            'contactLastName','contactFirstName',
            'phone','points']);
        return response($customers,200);
    }

    public function getByID($eid){
        $customers = customers::where('salesRepEmployeeNumber',$eid)->get(['customerNumber','customerName',
        'contactLastName','contactFirstName',
        'phone','points']);
        return response($customers);
    }

    public function create(Request $req , $id){
        
    }

    public function promote(Reqpromote $req){
        $validated = $req->validated();
        try{
            $id = $validated['employeeNumber'];
            $employee = employees::find($id);
            if(!is_null($employee)){
                DB::table('employees')->where('employeeNumber',$id)
                ->update([
                    'jobtitle' => $validated['jobtitle']
                ]);
                return response(["success" => true, "message" => "promote successfully",]);
            }
            return response(['success'=> false, 'data' => $validated],200);
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }
}
