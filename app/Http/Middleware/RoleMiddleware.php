<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    use ApiResponse;

    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return $this->errorResponse('Unauthenticated.', [], 401);
        }

        if (!in_array($user->role->value, $roles, true)) {
            return $this->errorResponse('Forbidden. Insufficient role.', [], 403);
        }

        return $next($request);
    }
}
