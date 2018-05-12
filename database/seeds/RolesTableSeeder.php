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
        $db = "eventos2";

        DB::table('roles')->insert([
            'name' => 'insignia',
            'slug' => 'insignia',
            'description' => 'rol para los miembros de insignia acceso total',
            'special' => 'all-access'
        ]);
        DB::connection($db)->table('roles')->insert([
            'name' => 'admin',
            'slug' => 'admin',
            'description' => 'Administrador - Tiene todos los permisos',
            'special' => 'all-access'
        ]);
        DB::connection($db)->table('roles')->insert([
            'name' => 'staff',
            'slug' => 'staff',
            'description' => 'Staff'
        ]);

    }
}
