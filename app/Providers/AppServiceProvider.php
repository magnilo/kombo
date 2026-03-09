<?php

namespace App\Providers;

use App\Models\OrganizationProfile;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        if (app()->runningInConsole()) {
            return;
        }

        try {
            $profile = Schema::hasTable('organization_profiles')
                ? OrganizationProfile::first()
                : null;
        } catch (QueryException) {
            $profile = null;
        }

        View::share('profile', $profile);
    }
}
