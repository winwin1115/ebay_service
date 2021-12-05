<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $item_id;
    public $item_name;
    public $user_name;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($item_id, $item_name, $user_name)
    {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('eBay Listing Product Alert!')
            ->from("shu0921tt@gmail.com")
            ->view('emails.mail')
            ->with([
                'item_id' => $this->item_id,
                'item_name' => $this->item_name,
                'user_name' => $this->user_name
            ]);
    }
}
