<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            'name' => 'Cedula de Ciudadania'
        ]);
        DB::table('document_types')->insert([
            'name' => 'Pasaporte'
        ]);
        DB::table('document_types')->insert([
            'name' => 'Tarjeta de Identidad'
        ]);
    }
}
