<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Post;
use App\Profile;
use App\MatchUser;
use App\Policies\ProfilePolicy;
use App\Policies\PostPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Profile::class => ProfilePolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show-message', function($user, $matchId) {
            return MatchUser::where('id', $matchId)
                            ->where(function($query) use ($user) {
                                $query->where('driver_id', $user->id)
                                    ->orWhere('rider_id', $user->id);
                            })
                            ->exists();
        });
    }
}
