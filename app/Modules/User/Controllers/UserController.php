<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\User\Requests\UserLoginRequest;
use App\Modules\User\Requests\UserRegisterRequest;
use App\Modules\User\Services\Interfaces\UserServiceInterface;

class UserController extends Controller 
{
    private $userService;
    
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * User register.
     * @param UserRegisterRequest $request
     * @return Response
     */
    public function register(UserRegisterRequest $request)
    {
       return $this->userService->register($request);
    }

    /**
     * User login.
     * @param UserLoginRequest $request
     * @return Response
     */
    public function login(UserLoginRequest $request)
    {
       return $this->userService->login($request);
    }
    

    /**
     * User logout.
     * @param Request $request
     */
    public function logout(Request $request)
    {
       return $this->userService->logout($request);
    }

     /**
     * Get current user.
     * @return Response
     */
    public function getCurrentUser()
    {
       return $this->userService->getCurrentUser();
    }

}