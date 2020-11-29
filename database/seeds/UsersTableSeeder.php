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
            'name' => 'admin',
            'email' => 'admin@email.com',
            'role_id' => '1',
        ]);

        $users[] = factory(App\User::class)->create([
            'name' => 'moderator',
            'email' => 'moderator@email.com',
            'role_id' => '2',
        ]);

        $users[] = factory(App\User::class)->create([
            'name' => 'writer',
            'email' => 'writer@email.com',
            'role_id' => '3',
        ]);

        $users[] = factory(App\User::class)->create([
            'name' => 'user',
            'email' => 'user@email.com',
            'role_id' => '4',
        ]);
    }
}
