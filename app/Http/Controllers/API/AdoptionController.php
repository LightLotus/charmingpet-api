<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdoptionController extends Controller
{
    public function index()
    {
        $adoption = Adoption::all();

        $adoptions = $adoption->map(function($adopt) {
            $adopt->petstatus = $adopt->acceptedStatus();
            return $adopt;
        });
        
        return response()->json([
            'status' => 200,
            'adoption' => $adoption,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'petname' => 'required',
            'status' => 'required',
            'description' => 'required',
            'animaltype' => 'required',
            'estbirthday' => 'required',
            'color' => 'required',
            'sex' => 'required',
            'imgsrc' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->messages(),
            ]);
        } else {
            $adoption = new Adoption;
            $adoption->petname = $request->input('petname');
            $adoption->status = $request->input('status');
            $adoption->description = $request->input('description');
            $adoption->animaltype = $request->input('animaltype');
            $adoption->estbirthday = $request->input('estbirthday');
            $adoption->color = $request->input('color');
            $adoption->sex = $request->input('sex');
            $adoption->imgsrc = $request->input('imgsrc');
            $adoption->save();

            return response()->json([
                'status' => 200,
                'message' => 'Pet Added Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $adoption = Adoption::find($id);
        $adoption->petstatus = $adoption->acceptedStatus();
        
        if ($adoption) {
            return response()->json([
                'status' => 200,
                'adoption' => $adoption,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No pet found'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'petname' => 'required',
            'status' => 'required',
            'description' => 'required',
            'animaltype' => 'required',
            'estbirthday' => 'required',
            'color' => 'required',
            'sex' => 'required',
            'imgsrc' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validateErrors' => $validator->messages(),
            ]);
        } else {
            $adoption = Adoption::find($id);
            if ($adoption) {
                $adoption->petname = $request->input('petname');
                $adoption->status = $request->input('status');
                $adoption->description = $request->input('description');
                $adoption->animaltype = $request->input('animaltype');
                $adoption->estbirthday = $request->input('estbirthday');
                $adoption->color = $request->input('color');
                $adoption->sex = $request->input('sex');
                $adoption->imgsrc = $request->input('imgsrc');
                $adoption->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Pet Details Updated Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Pet Found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $adoption = Adoption::find($id);
        if ($adoption) {
            $adoption->customers()->detach();
            $adoption->delete();
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

    public function adoptionDashboard($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $adoptions = $customer->adoptions;
        
            if ($adoptions) {
                return response()->json([
                    'status' => 200,
                    'adoptedPets' => $adoptions,
                ]); 
            }
        }

        return response()->json([
            'status' => 500,
            'message' => 'Error found',
        ]);
    }
}
