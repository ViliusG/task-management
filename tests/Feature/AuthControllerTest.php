<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_registers_a_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'email@gmail.com',
            'password' => 'Password123@',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);
    }

    public function test_it_logs_in_a_user()
    {
        $user = User::factory()->create([
            'password' => bcrypt('Password123@'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'Password123@',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token_type',
                'token',
            ]);
    }

    public function test_fails_login_because_of_wrong_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('Correct123@'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'Wrong123@',
        ]);

        $response->assertStatus(401)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function test_fails_login_because_of_non_existent_email()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'email@gmail.com',
            'password' => 'Password123@',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJsonStructure([
                'message',
            ]);
    }
}
