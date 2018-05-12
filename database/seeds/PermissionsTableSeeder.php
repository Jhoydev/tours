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
        $db = "eventos2";

        DB::connection($db)->table('permissions')->insert([
            'name' => 'create users',
            'slug' => 'user.create',
            'description' => 'Crear usuarios'
        ]);

        DB::connection($db)->table('permissions')->insert([
            'name' => 'edit users',
            'slug' => 'user.edit',
            'description' => 'Editar usuarios'
        ]);

        DB::connection($db)->table('permissions')->insert([
            'name' => 'delete users',
            'slug' => 'user.destroy',
            'description' => 'Eliminar usuarios'
        ]);

        DB::connection($db)->table('permissions')->insert([
            'name' => 'create events',
            'slug' => 'event.create',
            'description' => 'Crear eventos'
        ]);

        DB::connection($db)->table('permissions')->insert([
            'name' => 'edit event',
            'slug' => 'event.edit',
            'description' => 'Editar eventos'
        ]);

        DB::connection($db)->table('permissions')->insert([
            'name' => 'delete events',
            'slug' => 'event.destroy',
            'description' => 'Eliminar eventos'
        ]);
    }
}
