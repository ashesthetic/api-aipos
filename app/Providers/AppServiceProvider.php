<?php

namespace App\Providers;

use App\Modules\Options\Models\Option;
use App\Modules\Options\Policies\OptionPolicy;
use App\Modules\Users\Models\User;
use App\Modules\Users\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Option::class, OptionPolicy::class);
    }
}
