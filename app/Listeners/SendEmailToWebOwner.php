<?php

namespace App\Listeners;

use App\Events\MessageReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailToWebOwner implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  MessageReceived  $event
     * @return void
     */
    public function handle(MessageReceived $event)
    {
        $message = $event->message;
        $auth = $event->auth;
        if ($message->user_id) {
            $message->email = $auth->email;
            $message->nombre = $auth->name;
        }
        Mail::send('emails.contact', ['msg' => $message], function($m) use($message) {
            $m->from($message->email, $message->nombre)
                ->to('owner@dominandolaravel.com', 'Owner')
                ->subject('Tienes un nuevo mensaje');
        });
    }
}
