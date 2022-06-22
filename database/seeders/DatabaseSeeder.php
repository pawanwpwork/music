<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable all mass assignment restrictions
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SongSeeder::class);
        $this->call(BandDJAgeGroupSeeder::class);
        $this->call(BandDJEventTypeSeeder::class);
        $this->call(MemberShipTypeSeeder::class);
        $this->call(MusicGenreSeeder::class);
        $this->call(MusicCategorySeeder::class);
        $this->call(MemberShipSettingSeeder::class);
        $this->call(RateSettingSeeder::class);
        $this->call(CountrySeeder::class);
        // Re enable all mass assignment restrictions
        Model::reguard();
    }
}
