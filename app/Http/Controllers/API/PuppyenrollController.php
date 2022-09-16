<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Puppyenroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PuppyenrollController extends Controller
{
    public function index()
    {
        $puppyenroll = Puppyenroll::all();

        return response()->json([
            'status' => 200,
            'mannerenroll' => $puppyenroll,
        ]);
    }

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

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->messages(),
            ]);
        } else {
            $puppyenroll = new Puppyenroll;
            $puppyenroll->petname = $request->input('petname');
            $puppyenroll->age = $request->input('age');
            $puppyenroll->ownername = $request->input('ownername');
            $puppyenroll->email = $request->input('email');
            $puppyenroll->phonenumber = $request->input('phonenumber');
            $puppyenroll->address = $request->input('address');
            $puppyenroll->save();

            return response()->json([
                'status' => 200,
                'message' => 'Student Added Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $puppyenroll = Puppyenroll::find($id);
        if ($puppyenroll) {
            return response()->json([
                'status' => 200,
                'puppyenroll' => $puppyenroll,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Class Schedule Found',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'petname' => 'required',
            'age' => 'required',
            'ownername' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validationErrors' => $validator->messages(),

            ]);
        } else {
            $puppyenroll = Puppyenroll::find($id);
            if ($puppyenroll) {
                $puppyenroll->petname = $request->input('petname');
                $puppyenroll->age = $request->input('age');
                $puppyenroll->ownername = $request->input('ownername');
                $puppyenroll->email = $request->input('email');
                $puppyenroll->phonenumber = $request->input('phonenumber');
                $puppyenroll->address = $request->input('address');
                $puppyenroll->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Student/Pet Details Updated Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Student/Pet Found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $puppyenroll = Puppyenroll::find($id);
        if ($puppyenroll) {
            $puppyenroll->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student Details Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Class Schedule Found',
            ]);
        }
    }
}
