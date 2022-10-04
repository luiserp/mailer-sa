<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForQueuing extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The topic.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The topic.
     *
     * @var string
     */
    public $topic;


    /**
     * The content.
     *
     *  @var string
     */
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $email)
    {
        $this->user = $user;
        $this->topic = $email->topic;
        $this->content = $email->content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->user->email, $this->user->name)
            ->subject($this->topic)
            ->view('mails.email');
    }
}
