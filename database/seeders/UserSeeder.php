<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'Dozent',
            'Labyrinth',
            'Terdessa',
            'Battleships',
            'Memory',
            'Buenzlitum',
            'Hotels',
            'Poker',
            '5 Seen'
        ];

        foreach($users as $u){
            User::factory()->create([
                'name' => $u
            ]);
        }
    }
}
