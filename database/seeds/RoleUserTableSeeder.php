<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = "eventos";
        $tabla = "role_user";

        DB::connection($db)->table($tabla)->insert([
            'role_id' => 1,
            'user_id' => 1
        ]);
        DB::connection($db)->table($tabla)->insert([
            'role_id' => 1,
            'user_id' => 2
        ]);
        DB::connection($db)->table($tabla)->insert([
            'role_id' => 2,
            'user_id' => 3
        ]);
    }
}
