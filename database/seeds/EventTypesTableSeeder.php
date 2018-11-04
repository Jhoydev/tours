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
        DB::table('event_types')->insert([
            'name' => 'Evento Simple'
        ]);
        DB::table('event_types')->insert([
            'name' => 'Rueda de Negocios'
        ]);
        DB::table('event_types')->insert([
            'name' => 'Tours'
        ]);

        DB::table('event_statuses')->insert([
            'name' => 'En Venta'
        ]);
        DB::table('event_statuses')->insert([
            'name' => 'Agotado'
        ]);
        DB::table('event_statuses')->insert([
            'name' => 'Ventas Terminadas'
        ]);
        DB::table('event_statuses')->insert([
            'name' => 'Aun no Disponible'
        ]);
        DB::table('event_statuses')->insert([
            'name' => 'Cancelado'
        ]);
    }
}
