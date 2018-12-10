<?php

use ReclutaTI\SystemModule;
use Illuminate\Database\Seeder;

class SysteModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		'name' => 'sistema',
        		'slug' => 'system',
        	],

        	[
        		'name' => 'usuarios',
        		'slug' => 'users',
        		'parent' => 1
        	],

        	[
        		'name' => 'catalogo',
        		'slug' => 'catalog',
        	],

        	[
        		'name' => 'idiomas',
        		'slug' => 'languages',
        		'parent' => 3
        	],

        	[
        		'name' => 'estado civil',
        		'slug' => 'civil-statuses',
        		'parent' => 3
        	],

        	[
        		'name' => 'genero',
        		'slug' => 'gender',
        		'parent' => 3
        	],
        ];

        foreach ($data as $module) {
        	if (SystemModule::where('slug', $module['slug'])->get()->count() == 0) {
        		SystemModule::create($module);
        	}
        }
    }
}
