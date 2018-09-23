<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(GendersTableSeeder::class);

        $this->call(LanguagesTableSeeder::class);

        $this->call(EducativeLevelsTableSeeder::class);

        $this->call(StatesTableSeeder::class);

        $this->call(SkillLevelsTableSeeder::class);

        $this->call(CivilStatusesTableSeeder::class);

        $this->call(JobTypesTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
    }
}
