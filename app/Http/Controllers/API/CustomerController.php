<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();

        return response()->json([
            'status' => 200,
            'customer' => $customer,
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->messages(),
            ]);
        } else {
            $customer = new Customer;
            $customer->firstname = $request->input('firstname');
            $customer->lastname = $request->input('lastname');
            $customer->contactnumber = $request->input('contactnumber');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->save();

            return response()->json([
                'status' => 200,
                'message' => 'Successfully Queued!'
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
