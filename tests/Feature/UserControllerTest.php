<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin, 'sanctum');

        $response = $this->postJson('/api/users', [
            'hbkey' => 'unique_hbkey',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_birth' => '1990-01-01',
            'address' => '123 Main St',
            'role' => 'user',
            'password' => 'password',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function test_user_cannot_create_user()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/users', [
            'hbkey' => 'unique_hbkey',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_birth' => '1990-01-01',
            'address' => '123 Main St',
            'role' => 'user',
            'password' => 'password',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(403);
    }
}
