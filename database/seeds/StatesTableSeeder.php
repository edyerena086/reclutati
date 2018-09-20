<?php

use ReclutaTI\State;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Storage::disk('seeder')->exists('estados.csv')) {
        	$file = storage_path('app/seeder/estados.csv');
        	$csv = Reader::createFromPath($file);

        	foreach ($csv as $row) {
        		$stateName = strtolower($row[0]);

        		if (State::where('name', $stateName)->get()->count() == 0) {
        			State::create(['name' => utf8_encode($stateName)]);
        		}
        	}
        }
    }
}
