<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class EventCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $slug;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->name = $event->name;
        $this->slug = $event->slug;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@larvel.com', 'Laravel')->to(Auth::user()->email)->markdown('emails.event.created', [
            'name' => $this->name,
            'slug' => $this->slug,
        ]);
    }
}
