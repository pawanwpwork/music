<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('music_genres')->insert([
            'name' => 'Folk',
            'alias' => 'folk',
            'status' => 1
        ]);
        DB::table('music_genres')->insert([
            'name' => 'POP',
            'alias' => 'pop',
            'status' => 1
        ]);
        DB::table('music_genres')->insert([
            'name' => 'Rock',
            'alias' => 'rock',
            'status' => 1
        ]);
        DB::table('music_genres')->insert([
            'name' => 'Rap',
            'alias' => 'rap',
            'status' => 1
        ]);
        DB::table('music_genres')->insert([
            'name' => 'Hip Hop',
            'alias' => 'hip-hop',
            'status' => 1
        ]);
        DB::table('music_genres')->insert([
            'name' => 'Jazz',
            'alias' => 'jazz',
            'status' => 1
        ]);
        DB::table('music_genres')->insert([
            'name' => 'Other',
            'alias' => 'other',
            'status' => 1
        ]);
    }
}
