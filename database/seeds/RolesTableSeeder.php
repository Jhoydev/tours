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
            'name' => 'insignia',
            'slug' => 'insignia',
            'description' => 'rol para los miembros de insignia acceso total',
            'special' => 'all-access'
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'slug' => 'admin',
            'description' => 'rol para administrador de la compañia'
        ]);
        DB::table('roles')->insert([
            'name' => 'staff',
            'slug' => 'staff',
            'description' => 'staff'
        ]);
    }
}
