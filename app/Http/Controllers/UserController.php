<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
 
    public function __construct(
        protected UserRepository $users,
    ) {}

    /**
     * Register an user on application.
     * 
     * @param CreateUserRequest $request Validated user creation request.
     */
    public function store(CreateUserRequest $request): UserResource {
        $input = $request->only(['name', 'password', 'email']);
        $createdUser = $this->users->create($input);

        return new UserResource($createdUser);
    }
}
