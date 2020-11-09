<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class WebGSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            'Dozent',
            'Berglas & Eberhard',
            'Duenner',
            'Heule & Rapaport',
            'Kammer',
            'Probst',
            'v. Westendrop',
            'Halmi',
            'Thommen',
        ];

        foreach($users as $u){
            User::factory()->create([
                'name' => $u
            ]);
        }
    }
}
