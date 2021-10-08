<?php

namespace App\Http\Controllers;

use App\Http\Requests\addressReq;
use App\Models\customeraddresses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class employeeServiceController extends Controller
{
    public function getCustomerList(){
        $customers = DB::table('customers')
        ->get([ 'customerNumber','customerName',
            'contactLastName','contactFirstName',
            'phone','creditLimit']);
        return $customers;
    }

    public function getAddresses($id){
        $addresses = DB::table('customerAddresses')
        ->where('customerID',$id)
        ->get();
        $customer = DB::table('customers')
        ->where('customerNumber',$id)
        ->select('customerName','customerNumber')
        ->get();
        return ['addresses'=>$addresses, 'customer'=>$customer[0]];
    }
    
    public function createNewAddr(addressReq $req){
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
            return redirect("/add-address/{$validated['customerID']}")->with('status',"Insert successfully");
        }catch(Exception $e){
            return redirect("/add-address/{$validated['customerID']}")->with('failed',"operation failed");
        }
    }
    
    public function getAddress($id){
        $count = DB::table('customerAddresses')
        ->where('customerID',$id)
        ->count()+1;
        $cid = $id;
        return view('customer.address.option.addAddress',['count'=>$count,'cid'=>$cid]);
    }

    public function editAddr(addressReq $req){
        $validated = $req->validated();
        try {
            DB::table('customerAddresses')
                ->where('customerID',$validated['customerID'])
                ->where('addressNo',$validated['addressNo'])
                ->update([
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
            return redirect("/edit-address/{$validated['customerID']}/{$validated['addressNo']}")
                    ->with('status',"Edit successfully");
        } catch (Exception $e) {
            return redirect("/edit-address/{$validated['customerID']}/{$validated['addressNo']}")
                    ->with('failed',"operation failed");
        }
    }

    public function getEditAddr($id,$no){
        $addresses = DB::table('customerAddresses')
        ->where('customerID',$id)
        ->where('addressNo',$no)
        ->get();
        return view('customer.address.option.editAddress',
            ['address'=>$addresses[0]]);
    }

    public function delAddr($id,$no){
        $records = customeraddresses::where('customerID',$id)->count();
        if($records > 1 ){
            $selected = customeraddresses::where('customerId',$id)->where('addressNo', $no)->first()->selected;
            DB::table('customerAddresses')
            ->where('customerID',$id)
            ->where('addressNo',$no)
            ->delete();
            
            $addresses = DB::table("customeraddresses")->where('customerId',$id)->get();
            $i = 1;
            foreach($addresses as $address){
                if($selected == 1 && $i == 1){
                    DB::table('customerAddresses')
                    ->where('customerID',$id)
                    ->where('addressNo',$address->AddressNo)
                    ->update([
                        "addressNo" => $i,
                        "selected" => 1,
                    ]);
                }else{
                    DB::table('customerAddresses')
                    ->where('customerID',$id)
                    ->where('addressNo',$address->AddressNo)
                    ->update([
                        "addressNo" => $i,
                    ]);
                }
                $i++;
            }

            return redirect("/customer-address/{$id}")
            ->with('status',"Delete successfully!");
        }else{
            return redirect("/customer-address/{$id}")
                    ->with('failed',"must have at least 1 addresss !!!");
        }
    }

    public function createCustomerOrder(Request $request, $id){
        DB::table('orders')->insert([ 
            'orderNumber'   => $request->input('orderNumber'),
            'orderDate'     => $request->input('orderDate'),
            'requireDate'   => $request->input('reqDate'),
            'status'        => 'in progress',
            'customerNumber'=> $id
        ]);
    }

    public function updateCustomerOrder(Request $req, $oid){
        DB::table('orders')
        ->where('orderNumber',$oid)
        ->update([
            'shippedDate'   => $req->input('shippedDate'),
            'status'        => $req->input('status'),
            'comments'      => $req->input('comments')
        ]);
    }

    public function createCustomerAccount(Request $req , $id){
        
    }
}
