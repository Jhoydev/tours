<?php

use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('eventos')->table('event_types')->insert([
            'name' => 'Evento Simple'
        ]);
        DB::connection('eventos')->table('event_types')->insert([
            'name' => 'Rueda de Negocios'
        ]);
        DB::connection('eventos')->table('event_types')->insert([
            'name' => 'Tours'
        ]);

        DB::connection('eventos')->table('event_status')->insert([
            'name' => 'En Venta'
        ]);
        DB::connection('eventos')->table('event_status')->insert([
            'name' => 'Agotado'
        ]);
        DB::connection('eventos')->table('event_status')->insert([
            'name' => 'Ventas Terminadas'
        ]);
        DB::connection('eventos')->table('event_status')->insert([
            'name' => 'Aun no Disponible'
        ]);
    }
}
