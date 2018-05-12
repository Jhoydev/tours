<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('insignias')->insert([
            'name' => 'eventos2',
            'key_app' => 'eventos2',
            'database' => 'eventos2',
            'email' => 'eventos2@email.com',
            'phone' => '6587946',
            'web' => 'eventos2.com'
        ]);
        DB::connection('eventos2')->table('users')->insert([
            'first_name' => 'prueba nombre',
            'last_name' => 'prueba apellidos',
            'phone' => '987654321',
            'email' => 'eventos2@email.com',
            'password' => bcrypt('123456'),
            'company' => '1'
        ]);
        DB::connection('eventos2')->table('users')->insert([
            'first_name' => 'expoyoga',
            'last_name' => 'evento',
            'phone' => '987654321',
            'email' => 'expoyoga2@gmail.com',
            'password' => bcrypt('123456'),
            'company' => '1'
        ]);
        DB::connection('eventos2')->table('users')->insert([
            'first_name' => 'staff',
            'last_name' => 'evento',
            'phone' => '987654321',
            'email' => 'staff2@gmail.com',
            'password' => bcrypt('123456'),
            'company' => '1'
        ]);
    }
}
