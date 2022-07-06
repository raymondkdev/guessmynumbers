<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YourGameIsScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $game;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($game)
    {
        //
        $this->game = $game;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('smartdev0322@gmail.com', 'Guess My Numbers')
            ->subject('Your Game Is Scheduled!')
            ->view('emails.your_game_is_schduled');
    }
}
