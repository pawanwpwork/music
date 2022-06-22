<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id'   => 1,
            'name' => 'CD Store',
            'alias' => 'cd-store',
            'description' => 'CD Store',
            'sort_order' => 1,
        ]);

        DB::table('categories')->insert([
            'id'   => 2,
            'name' => 'CD Store  >  CD Equipment',
            'alias' => 'cd-store-cd-equipment',
            'description' => 'CD Store  >  CD Equipment',
            'parent'    => 1,
            'sort_order' => 2,
        ]);

        DB::table('categories')->insert([
            'id'    => 3,
            'name' => 'CD Store  >  CD Misc',
            'alias' => 'cd-store-cd-misc',
            'description' => 'CD Store  >  CD Misc',
            'parent'    => 1,
            'sort_order' => 3,
        ]);


        DB::table('categories')->insert([
            'id'    => 4,
            'name' => 'CD Store  >  CD Services',
            'alias' => 'cd-store-cd-services',
            'description' => 'CD Store  >  CD Services',
            'parent'    => 1,
            'sort_order' => 4,
        ]);

        DB::table('categories')->insert([
            'id'    => 5,
            'name' => 'Classified',
            'alias' => 'classified',
            'description' => 'Classified',
            'sort_order' => 5,
        ]);

        DB::table('categories')->insert([
            'id'   => 6,
            'name' => 'Classified > Classified Equipment',
            'alias' => 'classified-equipment',
            'description' => 'Classified > Classified Equipment',
            'parent'    => 5,
            'sort_order' => 6,
        ]);

        DB::table('categories')->insert([
            'id'    => 7,
            'name' => 'Classified > Classified Misc',
            'alias' => 'classified-misc',
            'description' => 'Classified  >  Classified Misc',
            'parent'    => 5,
            'sort_order' => 7,
        ]);


        DB::table('categories')->insert([
            'id'    => 8,
            'name' => 'Classified  >  Classified Services',
            'alias' => 'classified-services',
            'description' => 'Classified  >  Classified Services',
            'parent'    => 5,
            'sort_order' => 8,
        ]);
    }
}
