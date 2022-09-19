<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $status_code = 200;

    public function userSignUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|email",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "validation_error",
                "errors" => $validator->errors()
            ]);
        }

        $userDataArray = [
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ];

        $user_status = Customer::where("email", $request->email)->first();

        if (!is_null($user_status)) {
            return response()->json([
                "status" => "failed",
                "success" => false,
                "message" =>
                "Whoops! email already registered"
            ]);
        }

        $user = Customer::create($userDataArray);

        if (!is_null($user)) {
            return response()->json([
                "status" => $this->status_code,
                "success" => true,
                "message" => "Registration completed successfully",
                "data" => $user
            ]);
        }

        return response()->json([
            "status" => "failed",
            "success" => false,
            "message" => "failed to register"
        ]);
    }

    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "validation_error" => $validator->errors()
            ]);
        }

        $email_status = Customer::where("email", $request->email)->first();

        if (!is_null($email_status)) {
            $password_status = Customer::where("email", $request->email)->first();

            if (Hash::check($request->password, $password_status->password)) {
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
        if ($email != "") {
            $user = Customer::where("email", $email)->first();
            return $user;
        }
    }
}
