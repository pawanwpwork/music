<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberShipSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('membership_settings')->insert([
            'id'   => 1,
            'membership_type_id' => 1,
            'photo' => 1,
            'video' => 0,
            'song' => 0,
            'instrument' => 0,
			'full_access' => 0,
            'home_access' => 1,
            'about_us' => 1,
            'view_event' => 1,
            'post_event' => 0,
            'request_to_book_band' => 0,
            'post_classified' => 0,
            'view_classified' => 1,
            'cd_store' => 1,
            'cd_sell' => 0,
            'musian_search' => 0,
            'radio_submit' => 0,
            'radio_listen' => 1,
            'contact_us' => 1,
            'sign_up_fee' => 0,
            'sign_up_fee_duration' => null,
        ]);

        DB::table('membership_settings')->insert([
            'id'   => 2,
            'membership_type_id' => 2,
            'photo' => 3,
            'video' => 1,
            'song' => 0,
            'instrument' => 2,
            'full_access' => 0,
            'home_access' => 1,
            'about_us' => 1,
            'view_event' => 1,
            'post_event' => 0,
            'request_to_book_band' => 0,
            'post_classified' => 1,
            'view_classified' => 1,
            'cd_store' => 1,
            'cd_sell' => 0,
            'musian_search' => 0,
            'radio_submit' => 0,
            'radio_listen' => 1,
            'contact_us' => 1,
            'sign_up_fee' => 25,
            'sign_up_fee_duration' => 'year',
        ]);

        DB::table('membership_settings')->insert([
            'id'   => 3,
            'membership_type_id' => 3,
            'photo' => 5,
            'video' => 2,
            'song' => 2,
            'instrument' => 2,
            'full_access' => 0,
            'home_access' => 1,
            'about_us' => 1,
            'view_event' => 1,
            'post_event' => 0,
            'request_to_book_band' => 0,
            'post_classified' => 1,
            'view_classified' => 1,
            'cd_store' => 1,
            'cd_sell' => 1,
            'musian_search' => 1,
            'radio_submit' => 1,
            'radio_listen' => 1,
            'contact_us' => 1,
            'sign_up_fee' => 50,
            'sign_up_fee_duration' => 'year',
        ]);

        DB::table('membership_settings')->insert([
            'id'   => 4,
            'membership_type_id' => 4,
            'photo' => 5,
            'video' => 2,
            'song' => 2,
            'instrument' => 2,
            'full_access' => 1,
            'home_access' => 1,
            'about_us' => 1,
            'view_event' => 1,
            'post_event' => 1,
            'request_to_book_band' => 1,
            'post_classified' => 1,
            'view_classified' => 1,
            'cd_store' => 1,
            'cd_sell' => 1,
            'musian_search' => 1,
            'radio_submit' => 1,
            'radio_listen' => 1,
            'contact_us' => 1,
            'sign_up_fee' => 75,
            'sign_up_fee_duration' => 'year',
        ]);
        
    }
}
