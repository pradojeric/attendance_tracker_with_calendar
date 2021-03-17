<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('students', function($user){
            if($user->isStudent()) return true;
        });

        Gate::define('teacher-only', function($user, $room){
            if($user->isTeacher() && $user->roomTeacher->contains($room)) return true;
        });

        Gate::define('student-only', function($user, $room){
            if($user->isStudent() && $user->rooms->contains($room)) return true;
        });

        Gate::define('own-schedule-students', function($user, $schedule){
            if($user->rooms->map->schedules->flatten()->contains($schedule)) return true;
        });

        Gate::define('own-schedule-teacher', function($user, $schedule){
            if($user->roomTeacher->map->schedules->flatten()->contains($schedule)) return true;
        });
    }
}
