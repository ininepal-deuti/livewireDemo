<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginViaSanctumController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = Admin::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function register(Request $request)
    {
        $validation  = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        if($validation->fails()){
            return response()->json(['error'=> $validation->errors()],422);
        }

        $data = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make( $request->password),
        ]);
        $data['token'] = $data->createToken($request->name,['ability:admin'])->plainTextToken;

        return response()->json(['user'=> $data],200);
    }

    public function dashboard()
    {
        $users = Admin::find(auth()->user()->id);
        $success =  $users;
        $success['posts'] =  $users->posts();
        return response()->json($success, 200);

    }
}
