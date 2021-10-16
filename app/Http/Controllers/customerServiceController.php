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
    public function getSelaeRepByEmployee($id){
        $customers = DB::table('customers')
        ->join('employees','customers.salesRepEmployeeNumber','=','employees.employeeNumber')
        ->where('employees.employeeNumber',$id)
        ->get(['customerNumber','customerName','salesRepEmployeeNumber',
                'employeeNumber','lastname','jobTitle']);
        return $customers;
    }

    public function getTotalEachOrderByCustomer($id){
        $results = DB::select(DB::raw("
        SELECT  customers.customerName,
                orders.orderNumber, 
                orders.status,
                sum(orderdetails.priceEach)
        FROM    customers
        JOIN    orders on orders.customerNumber = customers.customerNumber
        JOIN    orderdetails on orderdetails.orderNumber = orders.orderNumber
        WHERE   customers.customerNumber = " . $id . "
        GROUP BY orders.orderNumber"));
        return $results;
    }

    public function point(Reqpoint $req){
        $validated = $req->validated();
        try{
            $id = $validated['customerNumber'];
            $customer = customers::find($id);
            if(!is_null($customer)){
                DB::table('customers')->where('customerNumber',$id)
                ->update([
                    'points' => $validated['points']
                ]);
                return response(["success" => true, "message" => "Point added",]);
            }
            return response(['success'=> false, 'data' => $validated],200);
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }

}
