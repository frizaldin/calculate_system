<?php

namespace App\Http\Middleware;

use App\Services\Interface\AuthServiceInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
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
        if ($this->authService->isAuthenticated()) {
            return redirect()->route('dashboard')
                ->with('info', 'Anda sudah login');
        }

        return $next($request);
    }
}
