<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ListUsersApiController extends BaseApiController
{
    public function __invoke(Request $request)
    {
        $usersQuery = QueryBuilder::for(User::class)
            ->defaultSort('name')
            ->allowedSorts(['name', 'email'])
            ->allowedFilters(['name', 'email'])
            ->paginate($request->get('per_page'))
            ->appends($request->query());

        return new UserResourceCollection($usersQuery);
    }
}
