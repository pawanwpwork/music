<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = [
    		[
    			'name' 	=> 'singer',
    			'alias' => 'singer',
    		],
    		[
    			'name' 	=> 'Saxophonist',
    			'alias' => 'saxophonist',
    		],
    		[
    			'name' 	=> 'Basoonist',
    			'alias' => 'basoonist',
    		],
    		[
    			'name' 	=> 'Guitarist',
    			'alias' => 'guitarist',
    		],
    		[
    			'name' 	=> 'Accordion',
    			'alias' => 'accordion',
    		],

    		// Start
    		[
    			'name' 	=> 'Bagpipes',
    			'alias' => 'bagpipes',
    		],

    		[
    			'name' 	=> 'Banjo',
    			'alias' => 'banjo',
    		],
    		[
    			'name' 	=> 'Bass guitar',
    			'alias' => 'bass-guitar',
    		],
    		[
    			'name' 	=> 'Bassoon',
    			'alias' => 'bassoon',
    		],
    		[
    			'name' 	=> 'Berimbau',
    			'alias' => 'berimbau',
    		],
    		[
    			'name' 	=> 'Harp',
    			'alias' => 'harp',
    		],
    		[
    			'name' 	=> 'Bongo',
    			'alias' => 'bongo',
    		],
    		[
    			'name' 	=> 'Cello',
    			'alias' => 'cello',
    		],
    		[
    			'name' 	=> 'Clarinet',
    			'alias' => 'clarinet',
    		],
    		[
    			'name' 	=> 'Harmonium',
    			'alias' => 'harmonium',
    		],
    		[
    			'name' 	=> 'Clavichord',
    			'alias' => 'clavichord',
    		],
    		[
    			'name' 	=> 'Cor anglais',
    			'alias' => 'cor-anglais',
    		],
    		[
    			'name' 	=> 'Cornet',
    			'alias' => 'cornet',
    		],
    		[
    			'name' 	=> 'Cymbal',
    			'alias' => 'cymbal',
    		],
    		[
    			'name' 	=> 'Dhime',
    			'alias' => 'dhime',
    		],
    		[
    			'name' 	=> 'Didgeridoo',
    			'alias' => 'didgeridoo',
    		],
    		[
    			'name' 	=> 'Dizi',
    			'alias' => 'dizi',
    		],
    		[
    			'name' 	=> 'Double bass',
    			'alias' => 'double-bass',
    		],
    		[
    			'name' 	=> 'Drum kit',
    			'alias' => 'drum-kit',
    		],
    		[
    			'name' 	=> 'Erhu',
    			'alias' => 'erhu',
    		],
    		[
    			'name' 	=> 'Euphonium',
    			'alias' => 'euphonium',
    		],
    		[
    			'name' 	=> 'Fiddle',
    			'alias' => 'fiddle',
    		],
    		[
    			'name' 	=> 'Flute',
    			'alias' => 'flute',
    		],
    		[
    			'name' 	=> 'French horn',
    			'alias' => 'french-horn',
    		],
    		[
    			'name' 	=> 'Glass harmonica',
    			'alias' => 'glass-harmonica',
    		],
    		[
    			'name' 	=> 'Glockenspiel',
    			'alias' => 'glockenspiel',
    		],

    		// next start
    		[
    			'name' 	=> 'Gong',
    			'alias' => 'gong',
    		],

    		[
    			'name' 	=> 'Guitar',
    			'alias' => 'guitar',
    		],

    		[
    			'name' 	=> 'Guqin',
    			'alias' => 'guqin',
    		],

    		[
    			'name' 	=> 'Guzheng',
    			'alias' => 'guzheng',
    		],

    		[
    			'name' 	=> 'Hang',
    			'alias' => 'hang',
    		],

    		[
    			'name' 	=> 'Harpsichord',
    			'alias' => 'harpsichord',
    		],

    		[
    			'name' 	=> 'Hammered dulcimer',
    			'alias' => 'hammered-dulcimer',
    		],

    		[
    			'name' 	=> 'Hulusi',
    			'alias' => 'hulusi',
    		],

    		[
    			'name' 	=> 'Hurdy gurdy',
    			'alias' => 'hurdy-gurdy',
    		],

    		[
    			'name' 	=> 'Jew’s harp',
    			'alias' => 'Jews-harp',
    		],

    		[
    			'name' 	=> 'Kalimba',
    			'alias' => 'kalimba',
    		],

    		[
    			'name' 	=> 'Lute',
    			'alias' => 'lute',
    		],

    		[
    			'name' 	=> 'Lyre',
    			'alias' => 'lyre',
    		],

    		[
    			'name' 	=> 'Mandolin',
    			'alias' => 'mandolin',
    		],

    		[
    			'name' 	=> 'Marimba',
    			'alias' => 'marimba',
    		],

    		[
    			'name' 	=> 'Melodica',
    			'alias' => 'melodica',
    		],

    		[
    			'name' 	=> 'Oboe',
    			'alias' => 'oboe',
    		],

    		[
    			'name' 	=> 'Ocarina',
    			'alias' => 'ocarina',
    		],

    		[
    			'name' 	=> 'Octobass',
    			'alias' => 'octobass',
    		],

    		[
    			'name' 	=> 'Organ',
    			'alias' => 'organ',
    		],

    		[
    			'name' 	=> 'Oud',
    			'alias' => 'oud',
    		],

    		[
    			'name' 	=> 'Pan Pipes',
    			'alias' => 'pan-pipes',
    		],

    		[
    			'name' 	=> 'Panduri',
    			'alias' => 'panduri',
    		],

    		[
    			'name' 	=> 'Piano',
    			'alias' => 'piano',
    		],

    		[
    			'name' 	=> 'Piccolo',
    			'alias' => 'piccolo',
    		],

    		[
    			'name' 	=> 'Pipa',
    			'alias' => 'pipa',
    		],

    		[
    			'name' 	=> 'Pungi',
    			'alias' => 'pungi',
    		],

    		[
    			'name' 	=> 'Recorder',
    			'alias' => 'recorder',
    		],

    		[
    			'name' 	=> 'Santoor',
    			'alias' => 'santoor',
    		],

    		[
    			'name' 	=> 'Sarod',
    			'alias' => 'sarod',
    		],

    		[
    			'name' 	=> 'Saxophone',
    			'alias' => 'saxophone',
    		],

    		[
    			'name' 	=> 'Shehnai',
    			'alias' => 'shehnai',
    		],

    		[
    			'name' 	=> 'Sheng',
    			'alias' => 'sheng',
    		],

    		[
    			'name' 	=> 'Sitar',
    			'alias' => 'sitar',
    		],

    		[
    			'name' 	=> 'Suona',
    			'alias' => 'suona',
    		],

    		[
    			'name' 	=> 'Synthesizer',
    			'alias' => 'synthesizer',
    		],

    		[
    			'name' 	=> 'Tabla',
    			'alias' => 'tabla',
    		],

    		[
    			'name' 	=> 'Tambourine',
    			'alias' => 'tambourine',
    		],

    		[
    			'name' 	=> 'Timpani',
    			'alias' => 'timpani',
    		],

    		[
    			'name' 	=> 'Triangle',
    			'alias' => 'triangle',
    		],


    		[
    			'name' 	=> 'Trombone',
    			'alias' => 'trombone',
    		],

    		[
    			'name' 	=> 'Trumpet',
    			'alias' => 'trumpet',
    		],

    		[
    			'name' 	=> 'Theremin',
    			'alias' => 'theremin',
    		],

    		[
    			'name' 	=> 'Tuba',
    			'alias' => 'tuba',
    		],

    		[
    			'name' 	=> 'Ukulele',
    			'alias' => 'ukulele',
    		],

    		[
    			'name' 	=> 'Viola',
    			'alias' => 'viola',
    		],

    		[
    			'name' 	=> 'Violin',
    			'alias' => 'violin',
    		],

    		[
    			'name' 	=> 'Vocal cords',
    			'alias' => 'vocal-cords',
    		],

    		[
    			'name' 	=> 'Whamola',
    			'alias' => 'whamola',
    		],

    		[
    			'name' 	=> 'Xylophone',
    			'alias' => 'xylophone',
    		],

    		[
    			'name' 	=> 'Zither',
    			'alias' => 'zither',
    		],

    	];
    	foreach($categories as $key => $cat){
    		DB::table('music_categories')->insert([
	            'id'   => $key + 1,
	            'name' => $cat['name'],
	            'alias' => $cat['alias'],
        	]);
    	}
    }
}
