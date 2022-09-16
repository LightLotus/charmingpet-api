<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PuppyController extends Controller
{
    public function index()
    {
        $puppy = Puppy::all();
        $puppy = $puppy->map(function ($puppy) {
            return [
                'id' => $puppy->id,
                'date' => date('F j, Y', strtotime($puppy->date)),
                'timestart' => date("g:i a", strtotime($puppy->timestart)),
                'timeend' => date("g:i a", strtotime($puppy->timeend)),
                'trainer' => $puppy->trainer,
                'availslot' => $puppy->availslot,
                'status' => $puppy->status
            ];
        });

        return response()->json([
            'status' => 200,
            'puppies' => $puppy,
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
            $puppy = new Puppy;
            $puppy->date = $request->input('date');
            $puppy->timestart = $request->input('timestart');
            $puppy->timeend = $request->input('timeend');
            $puppy->trainer = $request->input('trainer');
            $puppy->availslot = $request->input('availslot');
            $puppy->status = $request->input('status');
            $puppy->save();

            return response()->json([
                'status' => 200,
                'message' => 'Puppy Kindergarten Class Added Successfully',
            ]);
        }
    }

    public function edit($id)
    {
        $puppy = Puppy::find($id);
        if ($puppy) {
            return response()->json([
                'status' => 200,
                'puppy' => $puppy,
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
            $puppy = Puppy::find($id);
            if ($puppy) {
                $puppy->date = $request->input('date');
                $puppy->timestart = $request->input('timestart');
                $puppy->timeend = $request->input('timeend');
                $puppy->trainer = $request->input('trainer');
                $puppy->availslot = $request->input('availslot');
                $puppy->status = $request->input('status');
                $puppy->update();

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
        $puppy = Puppy::find($id);
        if ($puppy) {
            $puppy->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Puppy Kindergarten Class Schedule Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Class Schedule Found',
            ]);
        }
    }
}
