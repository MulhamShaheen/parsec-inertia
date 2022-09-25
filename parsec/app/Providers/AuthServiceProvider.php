<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use App\Models\Sanctum\PersonalAccessToken;
//use Laravel\Sanctum\Sanctum;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\User' => 'App\Policies\PostPolicy',
        'App\Project' => 'App\Policies\ProjectPolicy',
        'App\Resume' => 'App\Policies\ResumePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
//        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        $this->registerPolicies();

        Gate::define('open-admin-panel', function (User $user) {
            return $user->isAdmin();
        });
        Gate::define('create-project', function (User $user) {
            return $user->isEmployer();
        });
    }
}
