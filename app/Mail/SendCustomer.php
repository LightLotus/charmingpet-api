<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCustomer extends Mailable
{
    use Queueable, SerializesModels;
    private $password;
    private $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password, $name)
    {
        $this->password = $password;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.customer', [
            'password' => $this->password,
            'name' => $this->name
        ]);
    }
}
