<?php

namespace Tests\Unit\Models;

use App\Models\User;
use CodencoDev\EloquentModelTester\HasModelTester;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use HasModelTester;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_model_has_schema_and_is_fillable()
    {
        $this->modelTestable(User::class)
            ->assertHasColumns([
                'id',
                'name',
                'email',
                'email_verified_at',
                'password',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'two_factor_confirmed_at',
                'remember_token',
                'profile_photo_path',
                'created_at',
                'updated_at'
            ])
            ->assertCanFillables([
                'name',
                'email',
                'password',
            ]);
    }
}
