<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AuthInterface;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status'=>false, 'errors'=>$validator->errors()]);
        }

        $login_data = $this->auth->login($request->only('email', 'password'));
        
        if($login_data != 0)
        {
            return response()->json([
                'status' => true,
                'message' => 'You are logged in successfully!',
                'data' => $login_data
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Email or Password is incorrect'
            ]);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'dob' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status'=>false, 'errors'=>$validator->errors()]);
        }
        $user_add = $this->auth->register($request->all());
        if($user_add)
        {
            return response()->json([
                'status' => true,
                'message' => 'Registered successfully!'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Failed to register'
            ]);
        }

    }

    public function logout(Request $request)
    {
        $logout = $this->auth->logout();
        if($logout == 1)
        {
            return response()->json([
                'status' => true,
                'message' => 'You are logged out successfully!'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Failed to logout'
            ]);
        }
        
    }
}
