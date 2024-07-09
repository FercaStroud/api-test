<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin, 'sanctum');

        $response = $this->postJson('/api/categories', [
            'hbkey' => 'unique_hbkey',
            'name' => 'Test Category',
            'description' => 'This is a test category',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Test Category']);
    }

    public function test_can_view_categories()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'sanctum');

        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');
        $response->assertStatus(200)->assertJsonCount(3);
    }
}
