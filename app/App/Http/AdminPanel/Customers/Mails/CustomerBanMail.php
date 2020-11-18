<?php


namespace App\Http\AdminPanel\Customers\Mails;


use Illuminate\Mail\Mailable;

/**
 * Class CustomerBanMail
 * @package App\Http\AdminPanel\Customers\Mails
 */
class CustomerBanMail extends Mailable
{
//use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
            ->view('admin.emails.customer-ban', $this->details);
    }
}
