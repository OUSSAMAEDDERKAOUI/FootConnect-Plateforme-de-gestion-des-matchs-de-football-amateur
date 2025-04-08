<?php
namespace App\Http\Controllers\API\Auth;

use App\Models\AdminLigue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginUserRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\Auth\RegisterAdminLigueRequest;
use App\Services\AdminLigueService\AdminLigueService;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class AdminLigueController extends Controller
{
    protected $AdminLigueService;

    public function __construct(AdminLigueService $AdminLigueService)
    {
        $this->AdminLigueService = $AdminLigueService;
    }

    // public function registerAdminLigue(RegisterAdminLigueRequest $request)
    // {
    //     $validatedData = $request->validated();
    //     // dump($validatedData);

    //     $AdminLigue = $this->AdminLigueService->RegisterAdminLigue($validatedData);
    //     // dump($AdminLigue);

    //     if ($AdminLigue) {
    //         $token = Auth::guard('api')->login($AdminLigue);

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'User created successfully',
    //             'user' => $AdminLigue,
    //             'authorisation' => [
    //                 'token' => $token,
    //                 'type' => 'bearer',
    //             ]
    //         ]);
    //     }

    //     return response()->json([
    //         'error' => 'The email address is already registered. Please choose a different email.',
    //     ], 422);
    // }


//     



public function loginAdminLigue(LoginUserRequest $request)
{
    
    
    $request->validated();
    
    $credentials = $request->only('email', 'password');
    
    $result = $this->AdminLigueService->authenticate($credentials);
    
    if (!$result) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized Password or Email',
        ], 401);
    }
    $cookie = Cookie('Access-Token', $result['token'], 60, null, null, null, false);

    return response()->json([
        'status' => 'success',
        'user' => $result["user"],
        'authorisation' => [
            'token' => $result["token"],
            'type' => 'bearer',
        ]
    ])->withCookie($cookie);
    }




//     public function logout()
//     {
//         $this->AdminLigueService->logout();

//         // Retourner une réponse de succès après la déconnexion
//         return response()->json([
//             'status' => 'success',
//             'message' => 'Successfully logged out',
//         ]);
//     }


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