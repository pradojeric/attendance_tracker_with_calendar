<?php

use App\Room;
use App\Assignment;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Room::all()->each(function($room){
            $room->assignments()->createMany(factory(Assignment::class, 5)->make()->toArray());
        });
    }
}
