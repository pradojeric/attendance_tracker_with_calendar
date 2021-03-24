<?php

use App\User;
use App\Assessment;
use Illuminate\Database\Seeder;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Assessment::class, 2)->create();

        $students = User::with('roles')->whereHas('roles', function($query){
            $query->where('role' , 'student');
        })->get();

        Assessment::all()->each(function($assessment) use ($students){
            $data = [];
            foreach($students as $student){
                if(!$assessment->room->students->contains($student)) continue;
                if(rand(0,1) == 0) continue;
                $data[$student->id] = ['score' => rand(0,100)];
            }
            $assessment->students()->sync($data);
        });


    }
}
