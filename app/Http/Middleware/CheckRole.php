<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

// class CheckRole
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next, ...$roles)
// {
//     $user = $request->user();
//     $adminEquipe=$request->adminEquipe();

//     if (!$user) {
//         return response()->json([
//             'error' => 'User is not authenticated',
//             'message' => 'You need to be logged in to access this resource.'
//         ], Response::HTTP_UNAUTHORIZED);
//     }

//     if (!$this->hasValidRole($user, $roles)) {
//         return response()->json([
//             'error' => 'Forbidden',
//             'message' => 'You do not have the required permissions to access this resource.'
//         ], Response::HTTP_FORBIDDEN);
//     }

//     return $next($request);
// }


// private function hasValidRole($user, $roles)
// {
//     return in_array($user->role, $roles);
// }

// }


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $guards = [
            'api' => \App\Models\User::class,
            'api_admin_equipe' => \App\Models\AdminEquipe::class,
            'api_admin_ligue' => \App\Models\AdminLigue::class,
        ];

        foreach ($guards as $guard => $model) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                if (in_array($user->role, $roles)) {
                    return $next($request);
                }

                return response()->json(['message' => 'Unauthorized role'], 403);
            }
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
