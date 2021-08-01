<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserInterface;

class UserController extends Controller
{
    protected $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function create(Request $request)
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
        $create_user = $this->user->create($request->all());
        if($create_user)
        {
            return response()->json([
                'status' => true,
                'message' => 'User created successfully!'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create user'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'dob' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json(['status'=>false, 'errors'=>$validator->errors()]);
        }
        $update_user = $this->user->edit($request->all());
        if($update_user)
        {
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully!'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update user'
            ]);
        }
    }

    public function delete($id)
    {
        $delete_user = $this->user->delete($id);
        if($delete_user)
        {
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully!'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete user'
            ]);
        }
    }

    public function getUserById($id)
    {
        $user_by_id = $this->user->get($id);
        return response()->json([
            'status' => true,
            'data' => $user_by_id
        ]);
    }

    public function getAllUsers()
    {
        $all_users = $this->user->all();
        return response()->json([
            'status' => true,
            'data' => $all_users
        ]);
    }
}
