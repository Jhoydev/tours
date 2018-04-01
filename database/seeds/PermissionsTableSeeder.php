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
            'name' => 'create users',
            'slug' => 'user.create',
            'description' => 'poder crear usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'edit users',
            'slug' => 'user.edit',
            'description' => 'poder editar usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'delete users',
            'slug' => 'user.destroy',
            'description' => 'poder eliminar usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'create events',
            'slug' => 'event.create',
            'description' => 'poder crear eventos'
        ]);
    }
}
