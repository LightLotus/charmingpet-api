<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Mannerenroll;
use App\Models\Manner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCustomer;

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

    public function viewMannerEnrollees($id)
    {
        $manner = Manner::find($id);

        $enrollees = $manner->mannerenrolls->map(function($customer) {
            $customer->firstname = $customer->customer->firstname;
            return $customer;
        });

        return response()->json([
            'status' => 200,
            'mannerenroll' => $enrollees,
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
            $message = "";
            
            if (isset($request->logged_id)) { 
                $customer = Customer::find($request->logged_id);
            } else {
                $default_pass = Str::random(7);

                $customer = new Customer;
                $customer->firstname = $request->input('ownername');
                $customer->lastname = $request->input('lastname');
                $customer->contactnumber = $request->input('phonenumber');
                $customer->email = $request->input('email');
                $customer->address = $request->input('address');
                $customer->password = bcrypt($default_pass);
                $customer->save();

                Mail::to($request->input('email'))->send(new SendCustomer($default_pass, $request->input('ownername')));
                $message = "We've also sent you your default password to your email.";
            }

            $mannerenroll = new Mannerenroll;
            $mannerenroll->petname = $request->input('petname');
            $mannerenroll->age = $request->input('age');
            $mannerenroll->customer_id = $customer->id;
            $mannerenroll->save();
            $mannerenroll->manners()->attach($request->input('manner_id'));


            return response()->json([
                'status' => 200,
                'message' => "Student Added Successfully! \n$message"
            ]);
        }
    }

    public function edit($id)
    {
        $mannerenroll = Mannerenroll::find($id);
        $mannerenroll->ownername = $mannerenroll->customer->firstname;

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
            'age' => 'required'
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
            $mannerenroll->manners()->detach();
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

    public function petMannersDashboard($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $manners = $customer->mannerEnrollee;
        
            $mannerss = $manners->map(function($pups) {
                $pups->trainer = $pups->manners[0]->trainer;
                return $pups;
            });
            
            if ($manners) {
                return response()->json([
                    'status' => 200,
                    'mannerPups' => $mannerss,
                ]); 
            }
        }

        return response()->json([
            'status' => 500,
            'message' => 'Error found',
        ]);
    }
}
