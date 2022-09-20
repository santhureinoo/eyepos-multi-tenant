<?php

namespace App\Mail;

use App\Models\Customer\Examination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExaminationReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Examination Instance.
     *
     * @var \App\Models\Customer\Examination
     */
    public $examination;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Examination $examination)
    {
        $this->examination = $examination;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        view()->share('examination', $this->examination);
        $pdf = PDF::loadView('examination.report.show');

        return $this->from('falkvg@gmail.com')
            ->markdown('emails.examinations.report', [
                'examination' => $this->examination
            ])->attachData($pdf->output(), 'report.pdf', [
                'mime' => 'application/pdf'
            ]);
    }
}
