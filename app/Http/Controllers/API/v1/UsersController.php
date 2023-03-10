<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    use ResponseTrait;
    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $input = $request->only(['first_name', 'last_name', 'phone_number', 'email', 'password', 'confirm_password', 'address', 'landmark', 'city', 'state', 'postcode', 'country']);


        if ($user = $this->userRepository->createUser($input)) {

            return $this->responseSuccess($user);
        }

        return $this->responseError('Unable to create user');
    }


    /**
     * Create a new controller instance.
     *
     * @param LoginUserRequest $request
     * @return JsonResponse
     */

    public function login(LoginUserRequest $request): JsonResponse
    {

        $credentials = $request->only('email', 'password');

        if ($user = $this->userRepository->validateCredentials($credentials)) {
            return $this->responseSuccess($user,'Logged in successfully');
        }

        return $this->responseError('Invalid credentials');
    }

}
