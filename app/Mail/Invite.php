<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invite extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
       $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$fromAddress = env('MAIL_FROM_ADDRESS')?env('MAIL_FROM_ADDRESS'):'bala@pinpointt.com';
        $fromAddress = env('MAIL_FROM_ADDRESS')?env('MAIL_FROM_ADDRESS'):'janakiraman@proisc.com';
        return $this->from($fromAddress)
            ->view('kessler.email.invite')
            ->with([
                'name'=>$this->data->name,
                'email'=>$this->data->email,
                'password'=>$this->data->password
            ]);
    }
}
