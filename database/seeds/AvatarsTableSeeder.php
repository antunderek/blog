<?php

use Illuminate\Database\Seeder;

class AvatarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('avatars')->insert([
            [
                'id' => '1',
                'image_path' => 'public/avatars/default_avatar.png',
                'default' => true,
            ],
        ]);
    }
}
