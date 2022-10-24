<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([  // Ricordarsi di importare il namespace use App\User;
            'name' => 'Stefano',
            'email' => 's.cracco@yahoo.it',
            'password' => Hash::make('12345678') // Ricordarsi di importare use Illuminate\Support\Facades\Hash;
        ]);
    }
}
