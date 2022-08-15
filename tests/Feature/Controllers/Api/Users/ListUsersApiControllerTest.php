<?php

namespace Tests\Feature\Controllers\Api\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListUsersApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_list_users()
    {
        $this->json('get', route('api.v1.users.list'), [])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_returns_data_in_valid_format()
    {
        $this
            ->actingAs(User::factory()->create())
            ->json('get', route('api.v1.users.list'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'name',
                        'email',
                        'email_verified',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }
}
