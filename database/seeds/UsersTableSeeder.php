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
            'name' => 'turibus',
            'key_app' => 'turibus',
            'database' => 'eventos2',
            'email' => 'eventos2@email.com',
            'phone' => '6587946',
            'web' => 'eventos2.com'
        ]);
        DB::connection('eventos2')->table('users')->insert([
            'first_name' => 'Sofia',
            'last_name' => 'apellidos',
            'phone' => '987654321',
            'mobile' => '987654321',
            'address' => 'pepito perez 2',
            'city' => 'pereira',
            'state' => 'risaralda',
            'email' => 'eventos2@email.com',
            'password' => bcrypt('123456'),
            'company_id' => '1'
        ]);
        DB::connection('eventos2')->table('users')->insert([
            'first_name' => 'expoyoga',
            'last_name' => 'evento',
            'phone' => '987654321',
            'mobile' => '987654321',
            'address' => 'pepito perez 2',
            'city' => 'pereira',
            'state' => 'risaralda',
            'email' => 'expoyoga2@gmail.com',
            'password' => bcrypt('123456'),
            'company_id' => '1'
        ]);
        DB::connection('eventos2')->table('users')->insert([
            'first_name' => 'staff',
            'last_name' => 'evento',
            'phone' => '987654321',
            'mobile' => '987654321',
            'address' => 'pepito perez 2',
            'city' => 'pereira',
            'state' => 'risaralda',
            'email' => 'staff2@gmail.com',
            'password' => bcrypt('123456'),
            'company_id' => '1'
        ]);
    }
}
