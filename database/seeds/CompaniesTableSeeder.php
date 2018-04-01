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
            'phone' => '987654321',
            'email' => 'insignia@gmail.com',
            'address' => 'pepito de los palotes 12',
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://www.facebook.com/',
            'twitter' => 'https://www.facebook.com/',
        ]);

        DB::table('companies')->insert([
            'name' => 'expoyoga',
            'phone' => '987654321',
            'email' => 'expoyoga@gmail.com',
            'address' => 'julio saenz de la hoya 9',
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://www.facebook.com/',
            'twitter' => 'https://www.facebook.com/',
        ]);
    }
}
