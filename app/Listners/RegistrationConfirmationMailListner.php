<?php

namespace App\Listners;

use App\Events\NewUserHasRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationSuccessMail;

class RegistrationConfirmationMailListner
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
     * @param  NewUserHasRegisteredEvent  $event
     * @return void
     */
    public function handle(NewUserHasRegisteredEvent $event)
    {
        Mail::to('test@gmail.com')->send(new UserRegistrationSuccessMail($event->user,$event->userDetail));
    }
}
