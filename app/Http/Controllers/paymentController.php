<?php

namespace App\Http\Controllers;

use App\Http\Requests\paymentReq;
use App\Models\payments;
use Exception;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function insert(paymentReq $req){
        $validate = $req->validated();
        try{
            $payment = payments::insert([
                'customerNumber' => $validate['customerNumber'],
                'checkNumber' => $validate['checkNumber'],
                'paymentDate' => $validate['paymentDate'],
                'amount' => $validate['amount']
            ]);
            return response(["success" => true, "message" => "payment successful"]);
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }
}
