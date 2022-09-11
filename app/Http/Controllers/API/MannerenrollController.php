<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mannerenroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MannerenrollController extends Controller
{
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'petname' => 'required',
        'age' => 'required',
        'ownername' => 'required',
        'email' => 'required',
        'phonenumber' => 'required',
        'address' => 'required'
    ]);

    if ($validator->fails()){
        return response()->json([
            'status' => 422,
            'validate_err' => $validator->messages(),
        ]);
    } else {
        $mannerenroll = new Mannerenroll;
        $mannerenroll->petname = $request->input('petname');
        $mannerenroll->age = $request->input('age');
        $mannerenroll->ownername = $request->input('ownername');
        $mannerenroll->email = $request->input('email');
        $mannerenroll->phonenumber = $request->input('phonenumber');
        $mannerenroll->address = $request->input('address');
        $mannerenroll->save();

        return response()->json([
            'status' => 200,
            'message'=> 'Student Added Successfully'
        ]);
    }
    }
}