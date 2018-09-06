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
        DB::connection('eventos')->table('document_types')->insert([
            'name' => 'Cedula de Ciudadania'
        ]);
        DB::connection('eventos')->table('document_types')->insert([
            'name' => 'Pasaporte'
        ]);
        DB::connection('eventos')->table('document_types')->insert([
            'name' => 'Tarjeta de Identidad'
        ]);
    }
}
