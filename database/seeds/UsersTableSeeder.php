<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users[] = factory(App\User::class)->create([
            'name' => 'superuser',
            'email' => 'superuser@email.com',
            'role_id' => '5',
            'image_id' => '1',
        ]);

        $users[] = factory(App\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'role_id' => '1',
            'image_id' => '1',
        ]);

        $users[] = factory(App\User::class)->create([
            'name' => 'moderator',
            'email' => 'moderator@email.com',
            'role_id' => '2',
            'image_id' => '1',
        ]);

        $users[] = factory(App\User::class)->create([
            'name' => 'writer',
            'email' => 'writer@email.com',
            'role_id' => '3',
            'image_id' => '1',
        ]);

        $users[] = factory(App\User::class)->create([
            'name' => 'user',
            'email' => 'user@email.com',
            'role_id' => '4',
            'image_id' => '1',
        ]);
    }
}
