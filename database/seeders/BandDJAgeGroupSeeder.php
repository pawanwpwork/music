<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandDJAgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('band_dj_age_groups')->insert([
            'name' => '10 to 20',
            'alias' => '10-to-20'
        ]);

        DB::table('band_dj_age_groups')->insert([
            'name' => '20 to 40',
            'alias' => '20-to-40'
        ]);

        DB::table('band_dj_age_groups')->insert([
            'name' => '30 to 60',
            'alias' => '30-to-60'
        ]);

        DB::table('band_dj_age_groups')->insert([
            'name' => '60 and up',
            'alias' => '60-and-up'
        ]);
    }
}
