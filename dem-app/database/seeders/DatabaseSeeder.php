<?php

namespace Database\Seeders;

use App\Models\Profile;
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
        // \App\Models\User::factory(10)->create();
        Profile::create([
            'name'=>'admin',
            'description'=>'Administrateur du site'
        ]);
        Profile::create([
            'name'=>'AC',
            'description'=>'Agent de collecte (AC) Ou agent de communication digitale',
        ]);
        Profile::create([
            'name'=>'AD',
            'description'=>'Agent de dépôt /livraison',
        ]);
        Profile::create([
            'name'=>'client',
            'description'=>'un utilisateur du site'
        ]);

        User::create([
            'email' => 'abdoulayekeita438gmail.com',
            'password' =>  Hash::make('passer'),
            'profile_id' => 1,
        ]);
    }
}
