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
            return response()->json(['data'=> ['error' => $validator->errors()],'message'=>'Invalid inputs', 'success'=>0], 400);
        }

        try{
            $user = User::where('email','=',$request->email)->first();
            if(!$user)
            {
                return response()->json(['data' => '','message' => 'This User does not exist, check your details','success' => 0], 400);
            }

            $credentials = array('email'=>$request->email,'password'=>$request->password);

            if (!auth()->attempt($credentials)) {
                return response()->json(['data' => '','message' => 'This User does not exist, check your details','success' => 0], 400);
            }

            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response()->json(['data' => ['user' => auth()->user()], 'access_token' => $accessToken,'success' => 1,'message' => 'Login Successfully'],200);
        }catch (Exception $e) {
            if($request->ajax()) {
                return response()->json(['data' => '', 'message' =>'Something Went Wrong','success' => 0], 400);
            }
        }
    }

    public function forget_password(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);

        if($validator->fails()) { 
            return response()->json(['data' => ['error' => $validator->errors()],'message'=>'Invalid Inputs', 'success'=>0], 400);
        }
        try{

            $user = User::select('role_id')->where('email','=',$request->email)->first();
            if($user->role_id!=2)
            {
                return response()->json(['data' => '','message' => 'This User does not exist, check your details','success' => 0], 400);
            }
            $user = User::where('email','=',$request->email)->first();
            //$otp = mt_rand(1000, 9999);
            $otp = 1234;
            $user->otp = $otp;
            $user->save();

            return response()->json(['data' => ['user' => $user],'success' => 1,'message' => 'Login Successfully'],200);
        }catch (Exception $e) {
            if($request->ajax()) {
                return response()->json(['data' => '', 'message' =>'Something Went Wrong','success' => 0],400);
            }
        }
    }

    public function otp_verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required',
        ]);
        if($validator->fails()) { 
            return response()->json(['data' => ['error' => $validator->errors()],'message'=>'Invalid inputs', 'success'=>0], 400);
        }
        try{
            $user = User::where('email','=',$request->email)->where('otp','=',$request->otp)->first();  
            if($user)
            {
                return response()->json(['data' => '','success' => 1,'message' => 'OTP verified'],200);
            }else{
                return response()->json(['data' => '', 'message' =>'Something Went Wrong','success' => 0],400);
            }         
            
        }catch (Exception $e) {
            if($request->ajax()) {
                return response()->json(['data' => '', 'message' =>'Something Went Wrong','success' => 0],400);
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
            return response()->json(['data' => ['error' => $validator->errors()],'message'=>'Invalid input', 'success'=>0], 400);
        }

        try{
            $user = User::where('email','=',$request->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['data' => '','success' => 1,'message' => 'Password Updated'],200);

        }catch (Exception $e) {
            if($request->ajax()) {
                return response()->json(['data' => '', 'message' =>'Something Went Wrong','success' => 0],400);
            }
        }
    }

    public function logout()
    {
        try{
            $user = Auth::guard('api')->user()->token();
            $user->revoke();
            return response()->json(['data' => ['error' => $validator->errors()],'success' => 1,'message' => 'Successfully logged out'],200);
        }catch (Exception $e) {
            if($request->ajax()) {
                return response()->json(['data' => '', 'message' =>'Something Went Wrong','success' => 0],400);
            }
        }
    }
}
