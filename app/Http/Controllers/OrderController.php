<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(Request $request, $id){
        DB::table('orders')->insert([ 
            'orderNumber'   => $request->input('orderNumber'),
            'orderDate'     => $request->input('orderDate'),
            'requireDate'   => $request->input('reqDate'),
            'status'        => 'in progress',
            'customerNumber'=> $id
        ]);
    }

    public function update(Request $req, $oid){
        DB::table('orders')
        ->where('orderNumber',$oid)
        ->update([
            'shippedDate'   => $req->input('shippedDate'),
            'status'        => $req->input('status'),
            'comments'      => $req->input('comments')
        ]);
    }
}
