<?php

use ReclutaTI\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
        		'name' => 'Demon',
        		'email' => 'demon@reclutati.com',
        		'password' => bcrypt('Mku8njdro0@'),
        		'role_id' => \ReclutaTI\Role::ADMIN
        	]
        ];

        foreach ($data as $user) {
        	if (User::where('email', $user['email'])->first() == null) {
        		User::create($user);
        	}
        }
    }
}
