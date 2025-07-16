<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    protected AuthService $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = new AuthService();
    }

    public function test_signin_with_valid_credentials()
    {
        // Create test user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        // Create request
        $request = Request::create('/_signin', 'POST', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        // Test signin
        $result = $this->authService->signin($request);

        // Assertions
        $this->assertTrue($result['success']);
        $this->assertEquals('Login berhasil', $result['message']);
        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('redirect', $result);

        // Check if user is authenticated
        $this->assertTrue(Auth::check());
    }

    public function test_signin_with_invalid_credentials()
    {
        // Create test user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        // Create request with wrong password
        $request = Request::create('/_signin', 'POST', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword'
        ]);

        // Test signin
        $result = $this->authService->signin($request);

        // Assertions
        $this->assertFalse($result['success']);
        $this->assertEquals('Email atau password salah', $result['message']);
        $this->assertArrayHasKey('errors', $result);

        // Check if user is not authenticated
        $this->assertFalse(Auth::check());
    }

    public function test_signin_with_invalid_email()
    {
        // Create request with invalid email
        $request = Request::create('/_signin', 'POST', [
            'email' => 'invalid-email',
            'password' => 'password123'
        ]);

        // Test signin
        $result = $this->authService->signin($request);

        // Assertions
        $this->assertFalse($result['success']);
        $this->assertArrayHasKey('errors', $result);
    }

    public function test_logout()
    {
        // Create and authenticate user
        $user = User::factory()->create();
        Auth::login($user);

        // Test logout
        $result = $this->authService->logout();

        // Assertions
        $this->assertTrue($result['success']);
        $this->assertEquals('Logout berhasil', $result['message']);

        // Check if user is not authenticated
        $this->assertFalse(Auth::check());
    }

    public function test_is_authenticated()
    {
        // Initially not authenticated
        $this->assertFalse($this->authService->isAuthenticated());

        // Create and authenticate user
        $user = User::factory()->create();
        Auth::login($user);

        // Now should be authenticated
        $this->assertTrue($this->authService->isAuthenticated());
    }

    public function test_get_current_user()
    {
        // Initially no current user
        $this->assertNull($this->authService->getCurrentUser());

        // Create and authenticate user
        $user = User::factory()->create();
        Auth::login($user);

        // Now should have current user
        $currentUser = $this->authService->getCurrentUser();
        $this->assertNotNull($currentUser);
        $this->assertEquals($user->id, $currentUser->id);
    }
}
