<?php


namespace App\Http\AdminPanel\Admins\Mails;


use Illuminate\Mail\Mailable;

/**
 * Class AdminResetPasswordMail
 * @package App\Http\AdminPanel\Admins\Mails
 */
class AdminResetPasswordMail extends Mailable
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
            ->view('admin.emails.admin-reset-password', $this->details);
    }
}
