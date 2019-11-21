<?php

namespace App\Listeners;

use App\Events\StudentAdded;
use App\Mail\StudentAddedMail;
use Illuminate\Support\Facades\Mail;

class SendStudentAddedEmail
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
     * @param  StudentAdded  $event
     * @return void
     */
    public function handle(StudentAdded $event)
    {
        Mail::to($event->student->parent->email)->send(
            new StudentAddedMail($event->student)
        );
    }
}
