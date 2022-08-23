<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if($validator->fails()) { 
            return response()->json(['message'=>$validator->errors(), 'success'=>0], 400);
        }

        $user = User::where('email','=',$request->email)->first();
        if(!$user)
        {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $credentials = array('email'=>$request->email,'password'=>$request->password);

        if (!auth()->attempt($credentials)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function forget_password(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);

        if($validator->fails()) { 
            return response()->json(['message'=>$validator->errors(), 'success'=>0], 400);
        }

        $user = User::select('role_id')->where('email','=',$request->email)->first();
        if($user->role_id!=2)
        {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }
        $user = User::select('fname','lname','email')->where('email','=',$request->email)->first();
        return response(['user' => $user]);
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email|exists:users,email'
        ]);
        if($validator->fails()) { 
            return response()->json(['message'=>$validator->errors(), 'success'=>0], 200);
        }

        try{
            $user = User::where('email','=',$request->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['message' => 'Password Updated']);

        }catch (Exception $e) {
            if($request->ajax()) {
                return response()->json(['error' => trans('api.something_went_wrong')]);
            }
        }
    }
}
