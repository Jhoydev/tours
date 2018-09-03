<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('insignia.clientes')->insert([
            'name'       => 'Insignia',
            'key_app'    => 'insignia',
            'database'   => 'eventos',
            'phone'      => '3505781056',
            'email'      => 'hola@insignia.com.co',
            'address'    => 'Medellin, Colombia',
            'facebook'   => 'https://www.facebook.com/agenciainsignia',
            'instagram'  => 'https://www.facebook.com/agenciainsignia',
            'twitter'    => 'https://www.facebook.com/agenciainsignia',
            'created_at' => date("Y-m-d h:i:s")
        ]);

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
    }

}
