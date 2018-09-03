<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'insignia',
            'phone' => '3505781056',
            'email' => 'hola@insignia.com.co',
            'address' => 'Medellin, Colombia',
            'facebook' => 'https://www.facebook.com/agenciainsignia',
            'instagram' => 'https://www.facebook.com/agenciainsignia',
            'twitter' => 'https://www.facebook.com/agenciainsignia',
            'created_at' => date("Y-m-d h:i:s")
        ]);
    }
}
