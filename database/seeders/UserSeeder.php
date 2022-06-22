<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Super Admin',
            'last_name' => 'music',
            'email' => 'musicadmin@admin.com',
            'password' => bcrypt('musicadmin12#$%'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('p@ssw0rd'),
        ]);
       
    }
}
