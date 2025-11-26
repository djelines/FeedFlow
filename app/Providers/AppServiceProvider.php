<?php

namespace App\Providers;

use App\Models\Organization;
use App\Policies\OrganizationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Survey;
use App\Policies\SurveyPolicy;

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
    Gate::policy(Organization::class, OrganizationPolicy::class);
    Gate::policy(Survey::class, SurveyPolicy::class);
    
    View::composer('layouts.navigation', function ($view) {
       
       if(!Auth::check()){
           return;
       }
        $organization = Auth::user()->organizations;
        $view->with('organization', $organization);
    });

    }
}
