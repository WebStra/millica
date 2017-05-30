<?php

namespace App\Listeners;

use App\Events\UserCreationRequestSent;
use Illuminate\Foundation\Application;
use Mail;


class SendConfirmationCode
{


    /**
     * @var Application
     */
    private $application;

    /**
     * Create the event handler.
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreationRequestSent  $event
     * @return void
     */
    public function handle(UserCreationRequestSent $event)
    {
        $user    = $event->getUser();

        \Mail::send('emails.auth.verify', compact('user'), function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Verify Messsage!');
        });
    }
}