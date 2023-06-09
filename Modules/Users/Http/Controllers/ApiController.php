<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Users\Models\User;

class ApiController extends BaseApiController
{

    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(User::class)
            ->allowedFields([
                'users.id',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.activated',
                'users.superuser',
                'roles.name',
            ])
            ->allowedIncludes(['roles'])
            ->allowedSorts(['first_name', 'last_name', 'email', 'superuser', 'activated'])
            ->allowedFilters([
                AllowedFilter::custom('first_name,last_name,email', new FilterOr()),
            ])
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function updatePreferences(Request $request): void
    {
        $user = $request->user();
        $user->preferences = array_merge((array) $user->preferences, request()->all());
        $user->save();
    }

    public function destroy(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return response()->json([
                'error' => true,
                'message' => __('The current logged in user cannot be deleted.'),
            ], 403);
        }
        if (method_exists($user, 'mollieCustomerFields')) {
            if ($user->hasRunningSubscription()) {
                return response()->json([
                    'error' => true,
                    'message' => __('The user :name can not be deleted because he has a running subscription.', ['name' => "{$user->first_name} {$user->last_name}"]),
                ], 403);
            }
        }
        $user->delete();
    }

    public function updateCart(Request $request) {
        
        $userId = $request->user;
        $json = $request->cart;
        $total = $request->total;
        

        $user = User::where('id', $userId)->first();
        $user->cart = $json;
        $user->total_cart = $total;
        $user->save();
        
    }

    public function getUser(Request $request){
        $userId = $request->id;

        return json_decode(User::where('id', $userId)->first());
        
    }

    public function getCart(Request $request){
        $userId = $request->id;

        return json_decode(User::where('id', $userId)->first()->cart);
        
    }
}
