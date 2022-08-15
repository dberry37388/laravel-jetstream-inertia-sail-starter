<?php

namespace Tests\Feature\Controllers\Api\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StoreUserApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_new_user()
    {
        $this->json('post', route('api.v1.users.store'), [])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_a_new_user_is_created_successfully()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.org',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $this
            ->actingAs(User::factory()->create())
            ->json('post', route('api.v1.users.store'), $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'email_verified',
                    'created_at',
                    'updated_at',
                ]
            ]);

        $this->assertDatabaseHas('users', Arr::only($payload, ['name', 'email']));
    }
}
