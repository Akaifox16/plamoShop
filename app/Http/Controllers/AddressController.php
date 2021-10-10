<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\addressReq;
use App\Models\customeraddresses;
use App\Models\customers;
use Exception;

class AddressController extends Controller
{
    public function get($id){
        $customers = customers::find($id);
        $addresses = $customers->addresses()->get(['AddressLine1','AddressLine2','AddressNo',
                'City','State','PostalCode','Country']);
        $customer = $customers->get(['customerName','customerNumber']);
        return response(['addresses'=>$addresses, 'customer'=>$customer[0]],200);
    }
    
    public function create(addressReq $req){
        $validated = $req->validated();
        try{
            DB::table('customerAddresses')->insert([
                "customerID" => $validated['customerID'],
                "addressLine1" => $validated['addressLine1'],
                "addressLine2" => $validated['addressLine2'],
                "addressNo" => $validated['addressNo'],
                "selected" => 0,
                "city" => $validated['city'],
                "state" => $validated['state'],
                "postalCode" => $validated['postCode'],
                "country" => $validated['country']
            ]);
            return response(['success'=> true ,'data' => "Insert successfully"],201);
        }catch(Exception $e){
            return response(['success'=> false,'error' => "operation failed"],422);
        }
    }
    public function count($id){
        $count = customers::find($id)->addresses->count()+1;
        return response(['no'=>$count],200);
    }

    public function edit(addressReq $req){
        $validated = $req->validated();
        try {
            DB::table('customerAddresses')
                ->where('customerID',$validated['customerID'])
                ->where('addressNo',$validated['addressNo'])
                ->update([
                "addressLine1" => $validated['addressLine1'],
                "addressLine2" => $validated['addressLine2'],
                "city" => $validated['city'],
                "state" => $validated['state'],
                "postalCode" => $validated['postCode'],
                "country" => $validated['country']
            ]);
            return response(['success'=> true, 'data' => "Edit successfully"],200);
        } catch (Exception $e) {
            return response(['success'=> false,'error' => "operation failed"],204);
        }
    }

    public function getAddressNo($id,$no){
        $addresses = customeraddresses::find($id)
        ->where('addressNo',$no)
        ->get();
        return response(['address'=>$addresses[0]],200);
    }

    public function del($id,$no){
        $addresses = customeraddresses::find($id);
        $count = $addresses->count();
        if($count > 1){
            $addresses->where('AddressNo',$no)->delete();
            // DB::table('customerAddresses')
            // ->find("CustomerID",$id)
            // ->where("AddressNo",$no)
            // ->delete();
            // $i = 1;
            // foreach($addresses as $address){
            //     $address->addressNo = $i;
            //     $address->save();
            //     $i++;
            // }
            return response(['data'=>"deleted",'address' => $addresses],200);
        }
        return response(['error'=>"must have at least 1 address!!"],204);
    }
}
