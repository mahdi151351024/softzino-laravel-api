<?php 
namespace App\Repositories;
use App\User;

class UserRepository implements UserInterface
{
    public function create(array $data)
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

    public function edit(array $data)
    {
        $user = User::where('id', $data['id'])->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->dob = $data['dob'];
        if($user->update())
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function all()
    {
        $users = User::all();
        return $users;
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        if($user->delete())
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function get($id)
    {
        $user = User::find($id);
        return $user;
    }
}