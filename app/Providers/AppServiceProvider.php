<?php

namespace App\Providers;

use App\Models\Mentor;
use App\Models\User;
use App\Policies\MentorPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        Gate::before(function (User $user, string $ability) {
            if ($user->is_admin) {
                return true;
            }
        });

        Gate::define('delete-mentor', function (User $user) {
            return $user->is_admin;
        });*/
        Gate::policy(Mentor::class, MentorPolicy::class);

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(5)->by($request->user()->id);
            //return Limit::perMinute(5);
        });
    }
}
