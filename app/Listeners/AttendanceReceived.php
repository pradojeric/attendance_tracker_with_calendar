<?php

namespace App\Listeners;

use App\Events\AttendanceActivated;
use App\Notifications\EmailNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class AttendanceReceived
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AttendanceActivated  $event
     * @return void
     */
    public function handle(AttendanceActivated $event)
    {
        //
        Notification::send($event->students, new EmailNotification($event));
    }
}
