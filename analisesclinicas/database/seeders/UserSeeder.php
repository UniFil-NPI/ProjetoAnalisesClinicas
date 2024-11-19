<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'recepcionist']);
        Role::create(['name' => 'biomedic']);
        Role::create(['name' => 'patient']);


        User::create([
            'name' => 'admin',
            'email' => 'guilherme.vieira@edu.unifil.br',
            'cpf' => '618.837.920-29',
            'password' => Hash::make('123')
        ])->assignRole('admin');

        User::create([
            'name' => 'Clara Torres',
            'email' => 'clara.torres@gmail.com',
            'cpf' => '169.811.130-40',
            'password' => Hash::make('123')
        ])->assignRole('recepcionist');

        User::create([
            'name' => 'Roberto Silva',
            'email' => 'roberto.silva@gmail.com',
            'cpf' => '616.153.300-62',
            'password' => Hash::make('123')
        ])->assignRole('recepcionist');

        User::create([
            'name' => 'Juliana Francisca',
            'email' => 'juliana.francisca@gmail.com',
            'cpf' => '593.923.540-96',
            'password' => Hash::make('123')
        ])->assignRole('biomedic');

        User::create([
            'name' => 'Pedro Oliveira',
            'email' => 'pedro.oliveira@gmail.com',
            'cpf' => '255.825.840-05',
            'password' => Hash::make('123')
        ])->assignRole('biomedic');

        User::create([
            'name' => 'Larissa Rodrigues',
            'email' => 'larissa.rodrigues@gmail.com',
            'cpf' => '714.863.970-00',
            'password' => Hash::make('123')
        ])->assignRole('biomedic');

        User::create([
            'name' => 'Paulo Tavarez',
            'email' => 'paulo.tavarez@gmail.com',
            'cpf' => '136.483.140-68',
            'password' => Hash::make('123')
        ])->assignRole('patient');

        User::create([
            'name' => 'Joana Neves',
            'email' => 'joana.neves@gmail.com',
            'cpf' => '813.070.130-82',
            'password' => Hash::make('123')
        ])->assignRole('patient');

        User::create([
            'name' => 'Jack Jones',
            'email' => 'jack.jones@gmail.com',
            'cpf' => '952.510.680-26',
            'password' => Hash::make('123')
        ])->assignRole('patient');

    }
}
