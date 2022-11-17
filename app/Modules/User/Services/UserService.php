<?php

namespace App\Modules\User\Services;

use App\Helpers\TransformerResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Modules\User\Services\Interfaces\UserServiceInterface;
use App\Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserService implements UserServiceInterface
{

    private $transformerResponse;
    private $userRepository;

    const REGISTER_SUCCESS = 'Register success';
    const LOGIN_SUCCESS = 'Login success';
    const LOGOUT_SUCCESS = 'Logout success';

    public function __construct(
        TransformerResponse $transformerResponse,
        UserRepositoryInterface $userRepository,
    ) {
        $this->transformerResponse = $transformerResponse;
        $this->userRepository = $userRepository;
    }

    /**
     * User register.
     * @param  $request
     * @return Response
     */
    public function register($request)
    {
        try {
            $validated = $request->validated();

            $validated['password'] = Hash::make($validated['password']);

            $user = $this->userRepository->create($validated);
            
            return $this->transformerResponse->response(
                false,
                [
                    'user' => $user,
                ],
                TransformerResponse::HTTP_CREATED,
                self::REGISTER_SUCCESS
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }

    /**
     * User login.
     * @param  $request
     * @return Response
     */
    public function login($request)
    {
        $credentials =  $request->validated();

        if (!Auth::attempt($credentials)) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_UNAUTHORIZED,
                TransformerResponse::UNAUTHORIZED_MESSAGE
            );
        }
        try {
            $user = $request->user();
            $accessToken = $user->createToken("api_token")->accessToken;

            return $this->transformerResponse->response(
                false,
                [
                    'access_token' => $accessToken,
                ],
                TransformerResponse::HTTP_OK,
                self::LOGIN_SUCCESS
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }

    /**
     * User logout.
     * @param  $request
     * @return Response
     */
    public function logout($request)
    {
        try {
            // $request->user()->token()->revoke();
            $request->user()->authAccessTokens()->delete();
            return $this->transformerResponse->response(
                false,
                [],
                TransformerResponse::HTTP_OK,
                self::LOGOUT_SUCCESS
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }

    /**
     * Get current user.
     * @return Response
     */
    public function getCurrentUser()
    {
        try {
            $user = Auth::user();
            // $user = request()->user()->toArray();
            return $this->transformerResponse->response(
                false,
                [
                    'user' => $user,
                ],
                TransformerResponse::HTTP_OK,
                TransformerResponse::GET_SUCCESS_MESSAGE
            );
        } catch (QueryException $exception) {
            return $this->transformerResponse->response(
                true,
                [],
                TransformerResponse::HTTP_INTERNAL_SERVER_ERROR,
                TransformerResponse::INTERNAL_SERVER_ERROR_MESSAGE . "|" . $exception->getMessage()
            );
        }
    }
}
