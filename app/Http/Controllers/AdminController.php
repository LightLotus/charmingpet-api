<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private $status_code = 200;

    public function userLogin(Request $request) 
    {
        $validator = Validator::make($request->all(), [
                "email" => "required|email",
                "password" => "required"
            ]);

        if($validator->fails()) {
            return response()->json([
                "status" => "failed", 
                "validation_error" => $validator->errors()
            ]);
        }

        $email_status = User::where("email", $request->email)->first();

        if(!is_null($email_status)) {
            $password_status = User::where("email", $request->email)->first();
            
            if( Hash::check($request->password , $password_status->password) ) {
                $user = $this->userDetail($request->email);

                return response()->json([
                    "status" => $this->status_code, 
                    "success" => true, 
                    "message" => "You have logged in successfully", 
                    "data" => $user
                ]);
            }
        }

        return response()->json([
            "status" => "failed", 
            "success" => false, 
            "message" => "Unable to login. Invalid Credentials."
        ]);
    }

    public function userDetail($email) 
    {
        $user = [];
        if($email != "") {
            $user = User::where("email", $email)->first();
            return $user;
        }
    }
}
