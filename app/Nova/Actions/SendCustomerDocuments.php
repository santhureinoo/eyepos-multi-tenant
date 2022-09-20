<?php

namespace App\Nova\Actions;

use App\Events\CustomerVisitProcessed;
use App\Mail\Customer\AfterCare;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class SendCustomerDocuments extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection    $models
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            // Survey
            if ($fields->documents['survey']) {
                CustomerVisitProcessed::dispatch($model->visits->last());
            }
            // Examination
            if ($fields->documents['examination']) {
                view()->share('examination', $model->examinations->last());
                $pdf['report'] = PDF::loadView('examination.report.show');
            }
            // Receipt
            if ($fields->documents['receipt']) {
                view()->share('order', $model->orders->last());
                $pdf['receipt'] = PDF::loadView('pdf.receipt', array('order'=>$model->orders->last()));
            }
            Mail::to($model->email)->send(new AfterCare($model, $fields->subject, $fields->body, $pdf));
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Subject'),
            Textarea::make('Body'),
            BooleanGroup::make('Attach Latest Documents', 'documents')
                ->options([
                    'receipt'     => 'Receipt',
                    'examination' => 'Examination Report',
                    'survey'      => 'Customer Satisfaction Survey',
                ])
        ];
    }
}
