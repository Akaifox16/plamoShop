<?php

namespace App\Http\Controllers;

use App\Models\customers;
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
}
