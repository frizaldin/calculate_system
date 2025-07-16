<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthService implements AuthServiceInterface
{
    /**
     * Handle user signin process with database transaction
     *
     * @param Request $request
     * @return array
     */
    public function signin(Request $request): array
    {
        try {
            // Validate request
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            // Start database transaction
            DB::beginTransaction();

            try {
                // Attempt to authenticate user
                $credentials = [
                    'email' => $validated['email'],
                    'password' => $validated['password']
                ];

                if (Auth::attempt($credentials)) {
                    // Get authenticated user
                    $user = Auth::user();

                    // Update last login timestamp
                    $user->update([
                        'last_login_at' => now()
                    ]);

                    // Commit transaction
                    DB::commit();

                    return [
                        'success' => true,
                        'message' => 'Login berhasil',
                        'user' => $user,
                        'redirect' => route('dashboard')
                    ];
                } else {
                    // Rollback transaction
                    DB::rollBack();

                    return [
                        'success' => false,
                        'message' => 'Email atau password salah',
                        'errors' => ['email' => ['Email atau password tidak valid']]
                    ];
                }
            } catch (Exception $e) {
                // Rollback transaction on error
                DB::rollBack();

                Log::error('Auth signin error: ' . $e->getMessage(), [
                    'email' => $validated['email'],
                    'trace' => $e->getTraceAsString()
                ]);

                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Auth signin validation error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat login',
                'errors' => $e instanceof \Illuminate\Validation\ValidationException
                    ? $e->errors()
                    : ['general' => ['Terjadi kesalahan sistem']]
            ];
        }
    }

    /**
     * Handle user logout
     *
     * @return array
     */
    public function logout(): array
    {
        try {
            DB::beginTransaction();

            try {
                $user = Auth::user();

                if ($user) {
                    // Update logout timestamp
                    $user->update([
                        'last_logout_at' => now()
                    ]);
                }

                Auth::logout();

                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Logout berhasil'
                ];
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Auth logout error: ' . $e->getMessage());
                throw $e;
            }
        } catch (Exception $e) {
            Log::error('Auth logout error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat logout'
            ];
        }
    }

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return Auth::check();
    }

    /**
     * Get current authenticated user
     *
     * @return User|null
     */
    public function getCurrentUser(): ?User
    {
        return Auth::user();
    }
}
