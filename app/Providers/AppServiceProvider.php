<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;
use App\Models\MembershipSettings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function(View $view){
            $memberAccess = null;
            $sliderImages = getSliderImages();
            if(auth()->guard('member')->user() != null){
                $memberAccess = MembershipSettings::find(auth()->guard('member')->user()->membership_type_id);
            }
            $view->with('sliderImages', $sliderImages);
            $view->with('memberAccess', $memberAccess);
        });
    }
}
