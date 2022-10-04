<?php

namespace App\Jobs;

use App\Mail\EmailForQueuing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailsAndChangeState implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * The topic.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The topic.
     *
     * @var \App\Models\Email
     */
    public $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $email)
    {
        $this->user = $user;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email->addressee)->send(
            new EmailForQueuing($this->user, $this->email)
        );
        $this->email->status = 'sent';
        $this->email->save();
    }
}
