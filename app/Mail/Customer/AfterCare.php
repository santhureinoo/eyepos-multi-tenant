<?php

namespace App\Mail\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterCare extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $subject;
    public $body;
    public $pdfs = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $subject, $body, $pdfs)
    {
        $this->customer = $customer;
        $this->subject  = $subject;
        $this->body     = $body;
        $this->pdfs     = $pdfs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(isset($this->pdfs['report'])) {
            $this->attachData($this->pdfs['report']->output(), 'examination_report.pdf', [
                'mime' => 'application/pdf'
            ]);
        }
        if(isset($this->pdfs['receipt'])) {
            $this->attachData($this->pdfs['receipt']->output(), 'invoice.pdf', [
                'mime' => 'application/pdf'
            ]);
        }
        return $this->from('falkvg@gmail.com')
            ->subject($this->subject)
            ->markdown('emails.customer.aftercare', [
                'customer' => $this->customer,
                'body'     => $this->body
            ]);
    }
}
