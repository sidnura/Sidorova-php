<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Services\Users\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {

        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }
    

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $this->userService->updateUser($id, $request->validated());
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

}
