<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class StoreUserApiController extends BaseApiController
{
    public function __invoke(Request $request, CreatesNewUsers $creator)
    {
        event(new Registered($user = $creator->create($request->all())));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }
}
