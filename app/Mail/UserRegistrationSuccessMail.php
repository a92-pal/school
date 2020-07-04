<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistrationSuccessMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    public $user;
    public $userDetail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $userDetail)
    {
        $this->user=$user;
        $this->userDetail=$userDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registration is successful')
                ->markdown('emails.userRegistrationSuccessMail');
    }
}
