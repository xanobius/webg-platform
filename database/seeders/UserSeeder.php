<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maildomain = '@webg.ffhs.ch';

        User::updateOrCreate([
            'email' => 'group_01' . $maildomain
        ], [
            'name' => 'Labyrinth',
            'password' => bcrypt('asd123'),
            'api_token' => 'faczbr7CHe2rhVzSLgkO'
        ]);

        User::updateOrCreate([
            'email' => 'group_02' .$maildomain
        ], [
            'name' => 'Terdessa',
            'password' => bcrypt('asd123'),
            'api_token' => 'MPBQCFNkFJHAoTVyTA8f'
        ]);
    }
}
