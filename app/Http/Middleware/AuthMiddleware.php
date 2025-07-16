<?php

namespace App\Http\Middleware;

use App\Services\AuthServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->authService->isAuthenticated()) {
            return redirect()->route('signin')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}
