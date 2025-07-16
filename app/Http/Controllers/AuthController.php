<?php

namespace App\Http\Controllers;

use App\Services\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function signin()
    {
        return view('auth.signin');
    }

    public function _signin(Request $request)
    {
        try {
            $result = $this->authService->signin($request);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'redirect' => $result['redirect'],
                    'url' => url('/dashboard')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'],
                    'errors' => $result['errors'] ?? []
                ], 422);
            }
        } catch (\Exception $e) {
            Log::error('AuthController signin error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat login',
                'errors' => ['general' => ['Terjadi kesalahan sistem']]
            ], 500);
        }
    }

    public function logout()
    {
        try {
            $result = $this->authService->logout();

            if ($result['success']) {
                return redirect()->route('signin')
                    ->with('success', $result['message']);
            } else {
                return back()->with('error', $result['message']);
            }
        } catch (\Exception $e) {
            Log::error('AuthController logout error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Terjadi kesalahan saat logout');
        }
    }
}
