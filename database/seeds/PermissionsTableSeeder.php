<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'Crear Usuarios',
            'slug' => 'user.create',
            'description' => 'Crear usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'Editar Usuarios',
            'slug' => 'user.edit',
            'description' => 'Editar usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'Eliminar Usuarios',
            'slug' => 'user.destroy',
            'description' => 'Eliminar usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'Crear Eventos',
            'slug' => 'event.create',
            'description' => 'Crear eventos'
        ]);

        DB::table('permissions')->insert([
            'name' => 'Editar Eventos',
            'slug' => 'event.edit',
            'description' => 'Editar eventos'
        ]);

        DB::table('permissions')->insert([
            'name' => 'Eliminar Eventos',
            'slug' => 'event.destroy',
            'description' => 'Eliminar eventos'
        ]);
    }
}
