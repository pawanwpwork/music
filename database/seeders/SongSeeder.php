<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->insert([
            'title' => 'Test',
            'alias' => 'test',
            'label' => 'test',
            'artist' => 'Miguel',
            'duration' => 1,
            'status' => 1,
        ]);
    }
}
