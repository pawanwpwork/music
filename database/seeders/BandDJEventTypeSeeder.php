<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandDJEventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('band_dj_event_types')->insert([
            'name' => 'Wedding',
            'alias' => 'wedding'
        ]);

        DB::table('band_dj_event_types')->insert([
            'name' => 'Corporate Party',
            'alias' => 'corporate-party'
        ]);

        DB::table('band_dj_event_types')->insert([
            'name' => 'Picnic',
            'alias' => 'picnic'
        ]);

        DB::table('band_dj_event_types')->insert([
            'name' => 'Party',
            'alias' => 'party'
        ]);

        DB::table('band_dj_event_types')->insert([
            'name' => 'Birthday Party',
            'alias' => 'birthday-party'
        ]);

        DB::table('band_dj_event_types')->insert([
            'name' => 'Cabret',
            'alias' => 'cabret'
        ]);

        DB::table('band_dj_event_types')->insert([
            'name' => 'Other',
            'alias' => 'other'
        ]);
    }
}
