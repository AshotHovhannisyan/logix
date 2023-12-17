<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManageProfile extends Mailable
{
    use Queueable, SerializesModels;

    public $resetToken;
    public $subject;
    public $name;

    /**
     * Create a new message instance.
     *
     * @param $token
     * @param $subject
     * @param $name
     */
    public function __construct($token, $subject, $name)
    {
        $this->resetToken = $token;
        $this->subject = $subject;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.' . $this->name);
    }
}
