<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('users')->insert([
            'first_name' => 'Soporte',
            'last_name'  => 'Insignia',
            'phone'      => '987654321',
            'mobile'     => '987654321',
            'address'    => 'Calle falsa 123',
            'city'       => 'Medellin',
            'state'      => 'Antioquia',
            'email'      => 'francisco@insignia.com.co',
            'password'   => bcrypt('123456'),
            'company_id' => '1'
        ]);

        DB::table('users')->insert([
            'first_name' => 'Soporte 1',
            'last_name'  => 'Insignia',
            'phone'      => '987654321',
            'mobile'     => '987654321',
            'address'    => 'Calle falsa 123',
            'city'       => 'Elx',
            'state'      => 'Alicante',
            'email'      => 'jhoseph.dev@gmail.com',
            'password'   => bcrypt('123456'),
            'company_id' => '1'
        ]);

        DB::table('users')->insert([
            'first_name' => 'Soporte 2',
            'last_name'  => 'Insignia',
            'phone'      => '987654321',
            'mobile'     => '987654321',
            'address'    => 'Calle falsa 123',
            'city'       => 'Elx',
            'state'      => 'Alicante',
            'email'      => 'soporte2@correo.com',
            'password'   => bcrypt('123456'),
            'company_id' => '2'
        ]);
    }

}
