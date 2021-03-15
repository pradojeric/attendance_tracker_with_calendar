<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::insert([
            'name' => 'admin',
            'email' => 'admin@email',
            'email_verified_at' => now(),
            'password' => Hash::make("123456789"), // password
            'remember_token' => Str::random(10),
        ]);

        Role::insert([
            [
                'role' => 'admin'
            ],[
                'role' => 'teacher'
            ],[
                'role' => 'student'
            ]
        ]);

        User::find(1)->roles()->sync(1);
    }
}
