<?php
namespace App\Http\Controllers\API\Auth;
use App\Models\AdminLigue;

use App\Models\AdminEquipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdminEquipeService\AdminEquipeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginUserRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\Auth\RegisterAdminEquipeRequest;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class AdminEquipeController extends Controller
{
    protected $AdminEquipeService;

    public function __construct(AdminEquipeService $AdminEquipeService)
    {
        $this->AdminEquipeService = $AdminEquipeService;
    }

    public function registerAdminEquipe(RegisterAdminEquipeRequest $request)
    {
        $validatedData = $request->validated();
        
        $AdminEquipe = $this->AdminEquipeService->RegisterAdminEquipe($validatedData);
    
        if ($AdminEquipe) {
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $AdminEquipe
            ]);
        }
    
        return response()->json([
            'error' => 'The email address is already registered. Please choose a different email.',
        ], 422);
    }
    

//     



public function loginAdminEquipe(LoginUserRequest $request)
{
    
    
    $request->validated();
    
    $credentials = $request->only('email', 'password');
    
    $result = $this->AdminEquipeService->authenticate($credentials);

    if (!$result) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized Password or Email',
        ], 401);
    }
    
    $cookie = Cookie('Access-Token', $result['token'], 60, null, null, null, false);
    $userIdCookie = cookie('User-ID', $result['user']->id, 60, null, null, null, false); 
// dump($cookie);
    return response()->json([
        'status' => 'success',
        'user' => $result["user"],
        'authorisation' => [
            'token' => $result["token"],
            'type' => 'bearer',
        ]
    ])->withCookie($cookie)
    ->withCookie($userIdCookie); 

    }




//     public function logout()
//     {
//         $this->AdminEquipeService->logout();

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