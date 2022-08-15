<?php

namespace Tests\Feature\Controllers\Api\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateUserApiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $updateRoute = 'api.v1.users.update';

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_guest_cannot_update_existing_user()
    {
        $this->json('put', route($this->updateRoute,$this->user), [])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_a_user_can_be_updated()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.org',
        ];

        $this
            ->actingAs(User::factory()->create())
            ->json('put', route($this->updateRoute, $this->user), $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'email_verified',
                    'created_at',
                    'updated_at',
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => $payload['name'],
            'email' => $payload['email']
        ]);
    }
}
