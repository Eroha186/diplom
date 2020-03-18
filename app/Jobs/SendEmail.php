<?php

namespace App\Jobs;

use App\Events\SuccessMailSend;
use App\Mailing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $content;
    protected $idMailing;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $content
     * @param $idMailing
     */
    public function __construct($user, $content, $idMailing)
    {
        $this->user = $user;
        $this->content = stripcslashes($content);
        $this->idMailing = $idMailing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send([], [], function ($message) {
           $message->to($this->user->email)
               ->setBody($this->content, 'text/html');
        });
        event(new SuccessMailSend($this->idMailing));
    }
}
