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
            'email' => 'jhoseph.dev@gmail.com',
            'password' => bcrypt('123456'),
            'company_id' => '1'
        ]);
        DB::table('users')->insert([
            'first_name' => 'expoyoga',
            'email' => 'expoyoga@gmail.com',
            'password' => bcrypt('123456'),
            'company_id' => '2'
        ]);
    }
}
