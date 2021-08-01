<?php 
namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthRepository implements AuthInterface
{
    public function register(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->dob = $data['dob'];
        $user->password = Hash::make($data['password']);
        if($user->save())
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function login(array $data)
    {
        if(Auth::attempt($data))
        {
            $user = Auth::user();
            $user_data['id'] = $user->id;
            $user_data['access_token'] = $user->createToken('accessToken')->accessToken;
            return $user_data;
        }
        else
        {
            return 0;
        }
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return 1;
    }
}