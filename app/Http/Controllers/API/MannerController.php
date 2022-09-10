<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Manner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MannerController extends Controller
{
    public function index()
    {
        $manners = Manner::all();
        return response()->json([
            'status' => 200,
            'manners' => $manners,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'timestart' => 'required',
            'timeend' => 'required',
            'trainer' => 'required',
            'availslot' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->messages(),
            ]);
        } else {
            $manner = new Manner;
            $manner->date = $request->input('date');
            $manner->timestart = $request->input('timestart');
            $manner->timeend = $request->input('timeend');
            $manner->trainer = $request->input('trainer');
            $manner->availslot = $request->input('availslot');
            $manner->status = $request->input('status');
            $manner->save();

            return response()->json([
                'status' => 200,
                'message' => 'Manner Class Added Successfully',
            ]);
        }
    }

    public function edit($id)
    {
        $manner = Manner::find($id);
        if ($manner) {
            return response()->json([
                'status' => 200,
                'manner' => $manner,
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
            'date' => 'required',
            'timestart' => 'required',
            'timeend' => 'required',
            'trainer' => 'required',
            'availslot' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validationErrors' => $validator->messages(),
            ]);
        } else {
            $manner = Manner::find($id);
            if ($manner) {
                $manner->date = $request->input('date');
                $manner->timestart = $request->input('timestart');
                $manner->timeend = $request->input('timeend');
                $manner->trainer = $request->input('trainer');
                $manner->availslot = $request->input('availslot');
                $manner->status = $request->input('status');
                $manner->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Class Schedule Updated Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Class Schedule Found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $manner = Manner::find($id);
        if ($manner) {
            $manner->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Manner Class Schedule Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Class Schedule Found',
            ]);
        }
    }
}
