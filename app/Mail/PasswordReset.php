<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $to_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($to_email)
    {
        $this->to_email = $to_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->view('email.text')
            ->subject('再設定用のメール')
            ->with(['to_email' => $this->to_email]);
    }
}
