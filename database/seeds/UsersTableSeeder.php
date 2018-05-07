<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
        ]);
        $admin->roles()->attach([1, 2, 3]);

        factory(\App\User::class, 10)->create()->map(function ($user) {
            $user->roles()->attach(rand(2, 3));
        });
    }
}
