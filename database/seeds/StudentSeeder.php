<?php

use App\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
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
            'name' => 'teacher 1',
            'email' => 'teacher1@email',
            'email_verified_at' => now(),
            'password' => Hash::make("123456789"), // password
            'remember_token' => Str::random(10),
        ]);

        User::insert([
            'name' => 'teacher 2',
            'email' => 'teacher2@email',
            'email_verified_at' => now(),
            'password' => Hash::make("123456789"), // password
            'remember_token' => Str::random(10),
        ]);

        User::find(2)->roles()->sync(2);
        User::find(3)->roles()->sync(2);

        factory(User::class, 20)->create()->each(function ($user){
            $user->roles()->sync(3);
        });
    }
}
