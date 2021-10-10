<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class employeeServiceController extends Controller
{
    public function get(){
        $customers = DB::table('customers')
        ->get([ 'customerNumber','customerName',
            'contactLastName','contactFirstName',
            'phone','creditLimit']);
        return response($customers,200);
    }

    public function create(Request $req , $id){
        
    }
}
