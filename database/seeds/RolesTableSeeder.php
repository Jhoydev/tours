<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'slug' => 'admin',
            'description' => 'Rol dedicado a los clientes con permisos a nivel general sobre sus eventos.',
            'special' => 'all-access'
        ]);
        DB::table('roles')->insert([
            'name' => 'Staff',
            'slug' => 'staff',
            'description' => 'Rol para manejo simple de cada evento.'
        ]);

    }
}
