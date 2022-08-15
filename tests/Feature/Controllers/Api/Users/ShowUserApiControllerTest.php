<?php

namespace Tests\Feature\Controllers\Api\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowUserApiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $route = 'api.v1.users.show';

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email_verified_at' => now()
        ]);
    }

    public function test_guest_cannot_view_a_user()
    {
        $this->json('get', route($this->route, $this->user), [])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_a_authenticated_user_can_view_a_user()
    {
        $this
            ->actingAs(User::factory()->create())
            ->json('get', route($this->route, $this->user))
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'data' => [
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'email_verified' => true,
                    'created_at' => $this->user->created_at,
                    'updated_at' => $this->user->updated_at,
                ]
            ]);
    }
}
