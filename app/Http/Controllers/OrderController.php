<?php

namespace App\Http\Controllers;

use App\Http\Requests\orderPaymentReq;
use App\Models\orders;
use Carbon\Carbon;
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

    public function getLast(){
        $order = DB::table('orders')->get()->last();
        return $order->orderNumber +1;
    }

    public function updatePayment(orderPaymentReq $req){
        $validate = $req->validated();
        try{
            $paymentNumber = $validate['checkNumber'];
            DB::table('orders')->where('orderNumber',$validate['orderNumber'])
            ->update([
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
            'orderDate'     => Carbon::now()->toDate(),
            'status'        => 'In Process',
            'customerNumber'=> $id
        ]);
        
        return response($request->input('order'));
    }

    public function createDetails(Request $request){
        $i = 1;
        foreach ($request->input('order') as $o){ 
            $code = $o["productCode"];
            $qty =$o['quantityOrdered'];
            $price = $o['MSRP'];
            DB::table('orderdetails')->insert([
                'orderNumber' => $request->input('orderNumber'),
                'productCode' => $code,
                'quantityOrdered' => $qty,
                'priceEach' => $price,
                'orderLineNumber' => $i
            ]);
            $i += 1;
        }
        return response('create successfuly!');
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
