<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'name'      => 'Admin',
            'nip'      => 1234567890123456,
            'identity'      => 330406123456789,
            'email'     => 'admin@email.com',
            'password'  => bcrypt('123456789'),
            ])->assignRole('admin');

        User::create([
            'name'      => 'Guru',
            'nip'      => 1234567890123457,
            'identity'      => 330406123456781,
            'email'     => 'guru@email.com',
            'password'  => bcrypt('12345678'),
        ])->assignRole('guru');

        User::create([
            'name'      => 'Pokja PKL',
            'nip'      => 1234567890123458,
            'identity'      => 330406123456782,
            'email'     => 'pokja@email.com',
            'password'  => bcrypt('12345678'),
        ])->assignRole('pokja');
    }
}
