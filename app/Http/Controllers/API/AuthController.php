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
        $user = User::where('email','=',$request->email)->first();
        //$otp = mt_rand(1000, 9999);
        $otp = 1234;
        $user->otp = $otp;
        $user->save();

        return response(['user' => $user]);
    }

    public function otp_verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required',
        ]);
        if($validator->fails()) { 
            return response()->json(['message'=>$validator->errors(), 'success'=>0], 200);
        }
        try{
            $user = User::where('email','=',$request->email)->where('otp','=',$request->otp)->first();  
            if($user)
            {
                return response()->json(['message' => 'OTP verified']);
            }else{
                return response()->json(['error' => trans('Something Went Wrong')]);
            }         
            
        }catch (Exception $e) {
            if($request->ajax()) {
                return response()->json(['error' => trans('Something Went Wrong')]);
            }
        }
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email|exists:users,email',
            'otp' => 'required',
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
                return response()->json(['error' => trans('Something Went Wrong')]);
            }
        }
    }

    public function logout()
    {
        $user = Auth::guard('api')->user()->token();
        $user->revoke();
        return response()->json([
            'success' => 'Successfully logged out'
        ]);
    }
}
