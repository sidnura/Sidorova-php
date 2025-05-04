<?php

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function getAllUsers()
    {
        return User::get();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function getUserById(string $id)
    {
        return User::find($id);
    }

    public function updateUser(string $id, array $data)
    {
        $user = $this->getUserById($id);
        $user->update($data);

        return $user;
    }

    // public function deleteUser(User $user)
    // {
    //     return $user->delete();
    // }

}