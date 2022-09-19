<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mannerenroll;
use App\Models\Manner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MannerenrollController extends Controller
{
    public function index()
    {
        $mannerenroll = Mannerenroll::all();

        return response()->json([
            'status' => 200,
            'mannerenroll' => $mannerenroll,
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
            $mannerenroll = new Mannerenroll;
            $mannerenroll->petname = $request->input('petname');
            $mannerenroll->age = $request->input('age');
            $mannerenroll->ownername = $request->input('ownername');
            $mannerenroll->email = $request->input('email');
            $mannerenroll->phonenumber = $request->input('phonenumber');
            $mannerenroll->address = $request->input('address');
            $mannerenroll->save();
            $mannerenroll->manners()->sync($request->input('manner_id'));

            return response()->json([
                'status' => 200,
                'message' => 'Student Added Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $mannerenroll = Mannerenroll::find($id);
        if ($mannerenroll) {
            return response()->json([
                'status' => 200,
                'mannerenroll' => $mannerenroll,
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
            $mannerenroll = Mannerenroll::find($id);
            if ($mannerenroll) {
                $mannerenroll->petname = $request->input('petname');
                $mannerenroll->age = $request->input('age');
                $mannerenroll->ownername = $request->input('ownername');
                $mannerenroll->email = $request->input('email');
                $mannerenroll->phonenumber = $request->input('phonenumber');
                $mannerenroll->address = $request->input('address');
                $mannerenroll->update();

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
        $mannerenroll = Mannerenroll::find($id);
        if ($mannerenroll) {
            $mannerenroll->delete();
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

    public function mannerStatus($id)
    {
        if ($manner = Manner::find($id)) {
            $total_available = (int)$manner->availslot - (int)$manner->countEnrolled();

            return response()->json([
                'status' => 200,
                'message' => ($total_available ? "available" : "unavailable"),
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Error found',
        ]);
    }
}
