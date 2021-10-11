<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\addressReq;
use App\Models\customeraddresses;
use App\Models\customers;
use Exception;

class AddressController extends Controller
{
    public function get($cid){
        $customers = customers::find($cid);
        $addresses = $customers->addresses()->get(['id','AddressLine1','AddressLine2','AddressNo',
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
                "city" => $validated['city'],
                "state" => $validated['state'],
                "postalCode" => $validated['postCode'],
                "country" => $validated['country']
            ]);
            return response(['success'=> true ,'data' => "Insert successfully", 'inset' => $validated],201);
        }catch(Exception $e){
            return response(['success'=> false,'error' => "missing requirement"],422);
        }
    }
    public function count($cid){
        $count = customers::find($cid)->addresses->count()+1;
        return response(['no'=>$count],200);
    }

    public function edit(addressReq $req,$id){
        if($req->accepts('application/json')){
            $validated = $req->validated();
            try {
                customeraddresses::where('id',$id)
                ->update([
                    'addressLine1' => $validated['addressLine1'],
                    'addressLine2' => $validated['addressLine2'],
                    'city'         => $validated['city'],
                    'state'        => $validated['state'],
                    'postalCode'   => $validated['postCode'],
                    'country'      => $validated['country']
                ]);
                return response(['success'=> true, 'data' => $validated],200);
            } catch (Exception $e) {
                return response(['success'=> false,'error' => $e],204);
            }
        }
        return response(['success'=>false,'error'=> '[required]content-type: json'],204);
    }

    public function getAddress($id){
        $address = customeraddresses::find($id);
        return response(['address'=>$address],200);
    }

    public function del($id){
        $count = customeraddresses::get()->count();
        if($count > 1){
            $del = customeraddresses::find($id);
            $cid = $del->customer->customerNumber;
            $del->delete();
            $addresses = customeraddresses::where('customerID',$cid)->get();
            $i =1;
            foreach ($addresses as $address) {
                DB::table('customerAddresses')
                ->where('CustomerID',$cid)
                ->where('AddressNo',$address->addressNo)
                ->update([
                        "addressNo" => $i
                ]);
                $i++;
            }
            return response(['data'=> $del],200);
        }
        return response(['error'=>"must have at least 1 address!!"],204);
    }
}
