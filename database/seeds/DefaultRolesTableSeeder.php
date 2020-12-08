<?php

use Illuminate\Database\Seeder;

class DefaultRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('default_roles')->insert([
            [
                'id' => '1',
                'role_id' => '4',
            ],
        ]);
    }
}
