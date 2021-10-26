<?php

namespace App\Http\Controllers;

use App\Http\Requests\orderPaymentReq;
use App\Models\orders;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function get($cid){
        $orders = orders::where('customerNumber',$cid)->get(['orderNumber','orderDate','requiredDate','shippedDate','status','comments','paymentNumber'])
                    ;
        return response(['orders'=>$orders]);
    }

    public function getDetails($id){
        $orderDetails = orders::find($id)->orderDetails()->get(['productCode','quantityOrdered','priceEach','orderLineNumber']);
        return response(['orderDetails'=> $orderDetails]);
    }

    public function updatePayment(orderPaymentReq $req){
        $validate = $req->validated();
        try{
            $paymentNumber = $validate['checkNumber'];
            DB::table('orders')->where('orderNumber',$validate['orderNumber'])
            ->update([
                'status' => 'Shipped',
                'paymentNumber' => $paymentNumber
            ]);

            return response(["message" => "Update successfully", $paymentNumber]);
        }catch(Exception $e){
            return response($e,422);
        }
    }

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
