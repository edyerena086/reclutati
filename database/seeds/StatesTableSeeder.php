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
        $states = [
            [ 'name' => 'Aguascalientes' ],
            [ 'name' => 'Baja California' ],
            [ 'name' => 'Baja California Sur' ],
            [ 'name' => 'Campeche' ],
            [ 'name' => 'Coahuila' ],
            [ 'name' => 'Colima' ],
            [ 'name' => 'Chiapas' ],
            [ 'name' => 'Chihuahua' ],
            [ 'name' => 'Ciudad de México' ],
            [ 'name' => 'Durango' ],
            [ 'name' => 'Guanajuato' ],
            [ 'name' => 'Guerrero' ],
            [ 'name' => 'Hidalgo' ],
            [ 'name' => 'Jalisco' ],
            [ 'name' => 'Estado de México' ],
            [ 'name' => 'Michoacán' ],
            [ 'name' => 'Morelos' ],
            [ 'name' => 'Nayarit' ],
            [ 'name' => 'Nuevo León' ],
            [ 'name' => 'Oaxaca' ],
            [ 'name' => 'Puebla' ],
            [ 'name' => 'Querétaro' ],
            [ 'name' => 'Quintana Roo' ],
            [ 'name' => 'San Luis Potosí' ],
            [ 'name' => 'Sinaloa' ],
            [ 'name' => 'Sonora' ],
            [ 'name' => 'Tabasco' ],
            [ 'name' => 'Tamaulipas' ],
            [ 'name' => 'Tlaxcala' ],
            [ 'name' => 'Veracruz' ],
            [ 'name' => 'Yucatán' ],
            [ 'name' => 'Zacatecas' ]
        ];

        foreach ($states as $state) {
            if (State::where('name', $state['name'])->first() == null) {
                State::create($state);
            }
        }
    }
}
