<?php

namespace App\Http\Controllers;

use App\Models\customeraddresses;
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

}
