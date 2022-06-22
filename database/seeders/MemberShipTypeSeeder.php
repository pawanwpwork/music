<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberShipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership_types')->insert([
            'name' => 'Free Fan',
            'alias' => 'fan',
            'status' => 1
        ]);
        DB::table('membership_types')->insert([
            'name' => 'Membership Musician',
            'alias' => 'musician',
            'status' => 1
        ]);
        DB::table('membership_types')->insert([
            'name' => 'Membership Band Leader',
            'alias' => 'band',
            'status' => 1
        ]);
        DB::table('membership_types')->insert([
            'name' => 'Membership Event Promoter',
            'alias' => 'promoter',
            'status' => 1
        ]);
    }
}
