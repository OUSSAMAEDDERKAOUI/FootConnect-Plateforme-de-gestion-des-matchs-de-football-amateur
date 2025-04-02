<?php
namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterUserRequest $request)
    {
        $validatedData = $request->validated();
        // Dump($validatedData);
        $user = $this->userService->registerUser($validatedData);

        if ($user) {
            $token = Auth::guard('api')->login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'error' => 'The email address is already registered. Please choose a different email.',
        ], 422);
    }


//     


public function login(LoginUserRequest $request)
{

$request->validated();

$credentials = $request->only('email', 'password');

$result = $this->userService->authenticate($credentials);

if (!$result) {
    return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized Token',
    ], 401);
}

return response()->json([
    'status' => 'success',
    'user' => $result["user"],
    'authorisation' => [
        'token' => $result["token"],
        'type' => 'bearer',
    ]
]);
}




    public function logout()
    {
        $this->userService->logout();

        // Retourner une réponse de succès après la déconnexion
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }


//     // public function refresh()
//     // {
//     //     return response()->json([
//     //         'status' => 'success',
//     //         'user' => Auth::guard('api')->user(),
//     //         'authorisation' => [
//     //             'token' => Auth::guard('api')->refresh(),
//     //             'type' => 'bearer',
//     //         ]
//     //     ]);
//     // }


    
}