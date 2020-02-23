<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpressCompetitionDiplom extends Mailable
{
    use Queueable, SerializesModels;

    public $diplom;
    public $diplom_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($diplom)
    {
        $this->diplom = $diplom;
        $this->diplom_url = route('diplom', ['type_work' => $diplom->type, 'id_work' => $diplom->work_id]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.diplom');
    }
}
