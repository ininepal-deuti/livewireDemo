<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function customerLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }
        if(auth()->guard('customer')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'customer']);

            $customer = Customer::select('customers.*')->find(auth()->guard('customer')->user()->id);
            $success =  $customer;
            $success['token'] =  $customer->createToken('CustomerApp',['customer'])->accessToken;
            return response()->json($success, 200);
        }else{
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function customerLogout(Request $request) {
        $accessToken = auth()->guard('customer-api')->user()->token();
        $users = Customer::find(auth()->guard('customer-api')->user()->id);
        $token = $users->tokens->find($accessToken);
        $token->revoke();
        return response(['message' => 'You have been successfully logged out.'], 200);
    }

    public function customerDashboard()
    {
        $users = Customer::find(auth()->guard('customer-api')->user()->id);
        $success =  $users;
        $success['posts'] =  $users->posts();

        return response()->json($success, 200);
    }

    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'admin']);
            $admin = Admin::select('admins.*')->find(auth()->guard('admin')->user()->id);
            $success =  $admin;
            $success['token'] =  $admin->createToken('AdminApp',['admin'])->accessToken;
            return response()->json($success, 200);
        }else{
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function adminDashboard()
    {
        $users = Admin::find(auth()->guard('admin-api')->user()->id);
        $success =  $users;
        $success['posts'] =  $users->posts();

        return response()->json($success, 200);
    }

    public function adminLogout(Request $request) {
        $accessToken = auth()->guard('admin-api')->user()->token();
        $users = Admin::find(auth()->guard('admin-api')->user()->id);
        $token = $users->tokens->find($accessToken);
        $token->revoke();
        return response(['message' => 'You have been successfully logged out.'], 200);
    }
}
