<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Mail\PostPublishedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;

class NotifyPostPublished
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
     * @param  \App\Events\PostPublished  $event
     * @return void
     */
    public function handle(PostPublished $event): void
    {
        $data = [
            'title' => 'Mail from My Blog App',
            'body' => "Your Post with title: {$event->post->title} has been published."
        ];
        Mail::to($event->post->user->email)->send(new PostPublishedMail($data));
        flash('Mail sent!')->success();
    }
}
