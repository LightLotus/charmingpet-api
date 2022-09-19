<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCustomer;

class CustomerController extends Controller
{
    public function bax_lab_nica(Request $request)
    {
        $adoption = Adoption::find($request->id);
        $customer = $adoption->customers;

        return response()->json([
            'status' => 200,
            'customer' => $customer,
        ]);
    }

    public function nica_lab_bax(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $status = $customer->adoptions()->sync([$request->input('adoption_id') => ['status' => strtolower($request->status)]]);

        if ($status) {
            return response()->json([
                'status' => 200,
                'message' => "success"
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => "error"
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'contactnumber' => 'required',
            'email' => 'required',
            'address' => 'required',
            'dateinterview' => 'required',
            'timeinterview' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->messages(),
            ]);
        } else {
            $default_pass = Customer::DEFAULT_PASS;

            $customer = new Customer;
            $customer->firstname = $request->input('firstname');
            $customer->lastname = $request->input('lastname');
            $customer->contactnumber = $request->input('contactnumber');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->dateinterview = $request->input('dateinterview');
            $customer->timeinterview = $request->input('timeinterview');
            $customer->password = bcrypt($default_pass);
            $customer->save();
            $customer->adoptions()->sync($request->input('adoption_id'));
            Mail::to($request->input('email'))->send(new SendCustomer($default_pass, $request->input('firstname')));

            return response()->json([
                'status' => 200,
                'message' => 'Request Successful! You may now close this window and wait for an email confirmation'
            ]);
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return response()->json([
                'status' => 200,
                'customer' => $customer,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No User Found'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'contactnumber' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validateErrors' => $validator->messages(),
            ]);
        } else {
            $customer = Customer::find($id);
            if ($customer) {
                $customer->firstname = $request->input('firstname');
                $customer->lastname = $request->input('lastname');
                $customer->contactnumber = $request->input('contactnumber');
                $customer->email = $request->input('email');
                $customer->address = $request->input('address');
                $customer->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Customer Details Updated Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Customer Found',
                ]);
            }
        }
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Customer Details Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Customer Found',
            ]);
        }
    }
}