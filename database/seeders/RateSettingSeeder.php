<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('rate_settings')->insert([
        	'id'	=> 1,
            'event_per_day_rate' => 0.5,
            'book_band_dj_submission_rate' => 5,
            'classified_per_day_rate' => 6
        ]);
    }
}
