<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_book()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin, 'sanctum');

        $response = $this->postJson('/api/books', [
            'hbkey' => 'unique_hbkey',
            'title' => 'Test Book',
            'description' => 'This is a test book',
            'code' => 'unique_code',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('books', ['title' => 'Test Book']);
    }

    public function test_can_view_books()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'sanctum');

        Book::factory()->count(3)->create();

        $response = $this->getJson('/api/books');
        $response->assertStatus(200)->assertJsonCount(3);
    }
}
