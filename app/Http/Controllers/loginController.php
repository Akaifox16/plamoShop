<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginReq;
use App\Models\employees;
use App\Models\login;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function signup(loginReq $req){
        $validated = $req->validated();
        try{
            $id = $validated['employeeNumber'];
            $employee = login::find($id);
            if(!is_null($employee)){
                return response(["success" => false, "message" => "This user already registered"],422);
            }
            $newID = new login;
            $newID->employeeNumber = $id;
            $newID->password = Hash::make($validated['password']);
            $newID->save();

            return response(["success" => true, "data" => $newID],201);
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }

    public function login(loginReq $req){
        $validated = $req->validated();
        try{
            $id = $validated['employeeNumber'];
            $employee = login::find($id);
            if(!is_null($employee)){
                if(Hash::check($validated['password'],$employee->password)){
                    $employee = $this->employeeDetail($id);
                    return response(["success" => true, "message" => "You have logged in successfully", "data" => $employee]);
                }
                return response(["success" => false, "message" => "Cannot Login ,Invalid password!!",]);
            }
            return response(["success" => false, "message" => "this user isn't register yet!"]);
        }catch(Exception $e){
            return response(["success" => false, "message" => $e],422);
        }
    }

    public function employeeDetail($id)
    {
        if($id != ""){
            $employee = employees::find($id);
        }else{
            $employee = array();
        }
        return $employee;
    }
}
