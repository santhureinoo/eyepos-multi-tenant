<?php

namespace App\Mail\Customer\Reminders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EyeCheckReminderForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Customer Instance.
     *
     * @var
     */
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('falkvg@gmail.com')
            ->markdown('emails.customer.reminders.eyecheck');
    }
}
