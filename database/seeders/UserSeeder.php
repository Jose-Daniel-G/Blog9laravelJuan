<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Jose Daniel Grijalba Osorio',
            'sexo'=> randomElement(['M','F']),
            'telefono'=>'',
            'email'=> 'jose.jdgo97@gmail.com',
            'password'=> bcrypt('123123123'),
        ])->assignRole('Admin');
        User::create([
            'name'=>'Juan David Grijalba Osorio',
            'email'=> 'juandavidgo1997@gmail.com',
            'password'=> bcrypt('123123123'),
        ])->assignRole('Blogger');

        User::create([
            'name'=>'Hebron Customer',
            'email'=> 'hebron.customer@gmail.com',
            'password'=> bcrypt('123123123'),
        ]);

        User::factory(9)->create();
    }
}
