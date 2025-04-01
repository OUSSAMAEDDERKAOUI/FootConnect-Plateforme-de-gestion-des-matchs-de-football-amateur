<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    $user = $request->user();

    if (!$user) {
        return response()->json([
            'error' => 'User is not authenticated',
            'message' => 'You need to be logged in to access this resource.'
        ], Response::HTTP_UNAUTHORIZED);
    }

    if (!$this->hasValidRole($user, $roles)) {
        return response()->json([
            'error' => 'Forbidden',
            'message' => 'You do not have the required permissions to access this resource.'
        ], Response::HTTP_FORBIDDEN);
    }

    return $next($request);
}


private function hasValidRole($user, $roles)
{
    // Vérifier le rôle de l'utilisateur 
    return in_array($user->role, $roles);
}

}


