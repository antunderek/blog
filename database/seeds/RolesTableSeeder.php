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

                'create_role' => true,
                'edit_role' => true,
                'delete_role' => true,

                'create_user' => true,
                'edit_user' => true,
                'delete_user' => true,

                'edit_comment' => true,
                'delete_comment' => true,

                'create_media' => true,
                'edit_media' => true,
                'delete_media' => true,
            ],
            [
                'id' => '2',
                'role' => 'moderator',
                'writer' => true,
                'edit_article' => true,
                'delete_article' => true,

                'create_role' => false,
                'edit_role' => false,
                'delete_role' => false,

                'create_user' => false,
                'edit_user' => true,
                'delete_user' => false,

                'edit_comment' => false,
                'delete_comment' => true,

                'create_media' => true,
                'edit_media' => true,
                'delete_media' => true,
            ],
            [
                'id' => '3',
                'role' => 'writer',
                'writer' => true,
                'edit_article' => false,
                'delete_article' => false,

                'create_role' => false,
                'edit_role' => false,
                'delete_role' => false,

                'create_user' => false,
                'edit_user' => false,
                'delete_user' => false,

                'edit_comment' => false,
                'delete_comment' => false,

                'create_media' => false,
                'edit_media' => false,
                'delete_media' => false,
            ],
            [
                'id' => '4',
                'role' => 'user',
                'writer' => false,
                'edit_article' => false,
                'delete_article' => false,

                'create_role' => false,
                'edit_role' => false,
                'delete_role' => false,

                'create_user' => false,
                'edit_user' => false,
                'delete_user' => false,

                'edit_comment' => false,
                'delete_comment' => false,

                'create_media' => false,
                'edit_media' => false,
                'delete_media' => false,
            ],
            [
                'id' => '5',
                'role' => 'superuser',
                'writer' => true,
                'edit_article' => true,
                'delete_article' => true,

                'create_role' => true,
                'edit_role' => true,
                'delete_role' => true,

                'create_user' => true,
                'edit_user' => true,
                'delete_user' => true,

                'edit_comment' => true,
                'delete_comment' => true,

                'create_media' => true,
                'edit_media' => true,
                'delete_media' => true,
            ],
        ]);
    }
}
