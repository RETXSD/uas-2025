<?php

namespace App\Http\Middleware;

use App\Models\Pembeli;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $pembeli = Client::where('api_token', $token)->first();
        if (!$pembeli) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $request->merge(['authenticated_pembeli' => $pembeli ]) ;
        return $next($request);
    }
}
