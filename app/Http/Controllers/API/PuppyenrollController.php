<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Puppyenroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCustomer;
use App\Models\Puppy;

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

    public function viewKindergartenEnrollees($id)
    {
        $puppies = Puppy::find($id);

        $enrollees = $puppies->puppyenrolls->map(function($customer) {
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
            
            $puppyenroll = new Puppyenroll;
            $puppyenroll->petname = $request->input('petname');
            $puppyenroll->age = $request->input('age');
            $puppyenroll->customer_id = $customer->id;
            $puppyenroll->save();
            $puppyenroll->puppies()->attach($request->input('puppy_id'));

            return response()->json([
                'status' => 200,
                'message' => "Student Added Successfully \n$message"
            ]);
        }
    }

    public function edit($id)
    {
        $puppyenroll = Puppyenroll::find($id);
        $puppyenroll->ownername = $puppyenroll->customer->firstname;

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
            'age' => 'required'
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
            $puppyenroll->puppies()->detach();
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

    public function petClassesDashboard($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $kindergertens = $customer->kindergartenEnrollee;
        
            $kindergertenss = $kindergertens->map(function($pups) {
                $pups->trainer = $pups->puppies[0]->trainer;
                return $pups;
            });
            
            if ($kindergertens) {
                return response()->json([
                    'status' => 200,
                    'kindergartenPups' => $kindergertenss,
                ]); 
            }
        }

        return response()->json([
            'status' => 500,
            'message' => 'Error found',
        ]);
    }
}
