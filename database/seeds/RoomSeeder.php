<?php

use App\User;
use App\Room;
use App\Schedule;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Room::insert([
            ['name' => 'ROOM 1', 'teacher_id' => 2],
            ['name' => 'ROOM 2', 'teacher_id' => 3],
        ]);

        Schedule::insert([
            ['room_id' => 1, 'day' => 'Monday', 'start_class' => date('H:i', mktime(12,0)), 'end_class' => date('H:i', mktime(13,0))],
            ['room_id' => 1, 'day' => 'Tuesday', 'start_class' => date('H:i', mktime(12,0)), 'end_class' => date('H:i', mktime(13,0))],
            ['room_id' => 2, 'day' => 'Monday', 'start_class' => date('H:i', mktime(12,0)), 'end_class' => date('H:i', mktime(13,0))],
            ['room_id' => 2, 'day' => 'Monday', 'start_class' => date('H:i', mktime(14,0)), 'end_class' => date('H:i', mktime(15,0))],
        ]);

        $rooms = collect([1,2]);

        User::with(['roles'])->whereHas('roles', function($query){
            $query->where('role', 'student');
        })->each(function($user) use ($rooms){
            $user->rooms()->sync($rooms->random(rand(1,2)));
        });
    }
}
