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
    public function count($id){
        $count = customers::find($id)->addresses->count()+1;
        return response(['no'=>$count],200);
    }

    public function edit(addressReq $req){
        $validated = $req->validated();
        try {
            customeraddresses::where('CustomerID',$validated['customerID'])
                ->where('AddressNo',$validated['addressNo'])
                ->update([
                "AddressLine1" => $validated['addressLine1'],
                "AddressLine2" => $validated['addressLine2'],
                "City" => $validated['city'],
                "State" => $validated['state'],
                "PostalCode" => $validated['postCode'],
                "Country" => $validated['country']
            ]);
            return response(['success'=> true, 'data' => $validated],200);
        } catch (Exception $e) {
            return response(['success'=> false,'error' => $e],204);
        }
    }

    public function getAddress($id,$no){
        $address = customeraddresses::find($id)
        ->where('addressNo',$no)
        ->get();
        return response(['address'=>$address[0]],200);
    }

    public function del($id,$no){
        $addresses = customeraddresses::where('CustomerID',$id);
        $count = $addresses->count();
        if($count > 1){
            $del = $addresses->where('AddressNo',$no)->get();
            $addresses->where('AddressNo',$no)->delete();

            $addresses = customeraddresses::where('CustomerID',$id)->get();
            $i = 1;
            foreach($addresses as $address){
                DB::table('customerAddresses')
                ->where('CustomerID',$id)
                ->where('AddressNo',$address->AddressNo)
                ->update([
                        "addressNo" => $i
                ]);
                $i++;
            }
            return response(['data'=> $del[0]],200);
        }
        return response(['error'=>"must have at least 1 address!!"],204);
    }
}
