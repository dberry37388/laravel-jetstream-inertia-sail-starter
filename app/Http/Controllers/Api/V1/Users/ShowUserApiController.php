<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ShowUserApiController extends BaseApiController
{
    public function __invoke(Request $request, User $user)
    {
        return new UserResource($user);
    }
}
