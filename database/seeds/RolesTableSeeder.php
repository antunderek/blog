<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            [
                'id' => '1',
                'role' => 'admin',
                'writer' => true,
                'edit_article' => true,
                'delete_article' => true,
                'create_user' => true,
                'edit_user' => true,
                'delete_user' => true,
            ],
            [
                'id' => '2',
                'role' => 'moderator',
                'writer' => true,
                'edit_article' => true,
                'delete_article' => true,
                'create_user' => false,
                'edit_user' => true,
                'delete_user' => false,
            ],
            [
                'id' => '3',
                'role' => 'writer',
                'writer' => true,
                'edit_article' => false,
                'delete_article' => false,
                'create_user' => false,
                'edit_user' => false,
                'delete_user' => false,
            ],
            [
                'id' => '4',
                'role' => 'user',
                'writer' => false,
                'edit_article' => false,
                'delete_article' => false,
                'create_user' => false,
                'edit_user' => false,
                'delete_user' => false,
            ],
        ]);
    }
}
