<?php

namespace App\Services;

use Illuminate\Http\Request;

interface AuthServiceInterface
{
    /**
     * Handle user signin process
     *
     * @param Request $request
     * @return array
     */
    public function signin(Request $request): array;

    /**
     * Handle user logout
     *
     * @return array
     */
    public function logout(): array;

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated(): bool;

    /**
     * Get current authenticated user
     *
     * @return \App\Models\User|null
     */
    public function getCurrentUser(): ?\App\Models\User;
}
