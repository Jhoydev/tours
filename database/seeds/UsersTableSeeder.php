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
        DB::table('users')->insert([
            'first_name' => 'jhoseph',
            'last_name' => 'arango',
            'phone' => '987654321',

            'email' => 'jhoseph.dev@gmail.com',
            'password' => bcrypt('123456'),
            'company_id' => '1'
        ]);
        DB::table('users')->insert([
            'first_name' => 'expoyoga',
            'last_name' => 'evento',
            'phone' => '987654321',
            'email' => 'expoyoga@gmail.com',
            'password' => bcrypt('123456'),
            'company_id' => '2'
        ]);
        DB::table('users')->insert([
            'first_name' => 'staff',
            'last_name' => 'evento',
            'phone' => '987654321',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('123456'),
            'company_id' => '2'
        ]);
    }
}
