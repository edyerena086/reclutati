<?php

use ReclutaTI\CivilStatus;
use Illuminate\Database\Seeder;

class CivilStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
        	[
        		'name' => 'soltero(a)'
        	],

        	[
        		'name' => 'unión libre'
        	],

        	[
        		'name' => 'casado(a)'
        	],

        	[
        		'name' => 'divorciado(a)'
        	],

        	[
        		'name' => 'viudo(a)'
        	],

        	[
        		'name' => 'otro'
        	]
        ];

        foreach ($statuses as $status) {
        	if (CivilStatus::where('name')->first() == null) {
        		CivilStatus::create($status);
        	}
        }
    }
}
