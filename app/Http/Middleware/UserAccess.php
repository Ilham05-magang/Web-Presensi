<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    public function handle(Request $request, Closure $next, $roleName): Response
    {
        if (auth()->user()->role->role == $roleName && auth()->user()->status_akun == 1) {
            $response = $next($request);

            // Check if response is an instance of BinaryFileResponse
            if ($response instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
                // Return the response with additional headers
                return $response;
            }

            // Modify headers for other response types
            return $response->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
        }

        return redirect()->back();
    }
}
