<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $names = [
            'Category',
            'Product',
            'Song',
            'Review',
            'Event',
            'BandDjEventType',
            'BandDjAgeGroup',
            'BandDjBook',
            'Member',
            'MusicGenre',
            'MusicCategory',
            'SiteSetting',
            'SliderImage',
            'MemberSetting',
            'MemberPhoto',
            'MemberVideo',
            'MemberInstrument',
            'MemberSong',
            'Cart',
            'RateSetting',
            'Order'
        ];
        foreach ($names as $name) {
            $this->app->bind(
                "App\\Music\\Repositories\\{$name}\\{$name}Interface",
                "App\\Music\\Repositories\\{$name}\\{$name}Repository"
            );
        }
    }
}
