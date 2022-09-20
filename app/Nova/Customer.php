<?php

namespace App\Nova;

use App\Nova\Actions\SendCustomerDocuments;
use Customer\Vision;
use Customer\Visit;
use Customer\Examination;
use Customer\Document;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Yassi\NestedForm\NestedForm;
use Illuminate\Support\Facades\Log;


class Customer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Customers::class;

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->first_name . ' ' . $this->last_name . (isset($this->email) ? ' (' . $this->email . ')' : '');
    }

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Services';

    /**
     * The side nav menu order.
     *
     * @var int
     */
    public static $priority = 2;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    /**
     * The visual style used for the table. Available options are 'tight' and 'default'.
     *
     * @var string
     */
    public static $tableStyle;

    /**
     * Indicates whether Nova should prevent the user from leaving an unsaved form, losing their data.
     *
     * @var bool
     */
    public static $preventFormAbandonment = true;

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        $outlet_id = intval($request->session()->get('outlet_id'));

        Log::info("outletId from create: $outlet_id");
        return [
            Tabs::make('Create Customer', [
                Tab::make('Overview', [
                    Text::make('Outlet ID', 'outlet_id')
                    ->default($outlet_id)
                    ->withMeta(['extraAttributes' => [
                        'readonly' => true
                    ]]),
                    Text::make('Name', function () {
                        return $this->first_name . ' ' . $this->last_name;
                    })->exceptOnForms(),
                    Text::make('First Name')
                        ->hideFromIndex(),
                    Text::make('Last Name')
                        ->hideFromIndex(),
                    Text::make('Email'),
                    Text::make('Phone'),
                    Date::make('Date of Birth', 'dob')
                        ->format('DD/MM/YYYY')
                        ->hideFromIndex(),
                    Select::make('Gender')
                        ->options([
                            'Male'   => 'Male',
                            'Female' => 'Female',
                            'Other'  => 'Other'
                        ])
                        ->hideFromIndex(),
                    Text::make('Company', 'company_name')
                        ->hideFromIndex(),
                    Text::make('Occupation')
                        ->hideFromIndex(),
                    Text::make('Insurance')
                        ->hideFromIndex(),
                    Text::make('Reference')
                        ->hideFromIndex(),

                    Boolean::make('Consent to Marketing Material', 'consent_marketing')
                        ->hideFromIndex(),
                    Boolean::make('Consent to Notifications and Reminders', 'consent_notifications')
                        ->hideFromIndex(),

                    NestedForm::make(Vision::class, 'vision')->heading('Prescriptions'),
                    NestedForm::make(Visit::class, 'visits')->heading('Visits'),
                    NestedForm::make(Examination::class, 'examinations'),
                    NestedForm::make(Document::class, 'documents'),
                    // TODO: Orders
                    // NestedForm::make('Orders'),
                ]),
                Tab::make('Prescription', [
                    HasMany::make(Vision::class, 'vision'),
                ]),
                Tab::make('Visits', [
                    HasMany::make(Visit::class, 'visits'),
                ]),
                Tab::make('Examinations', [
                    HasMany::make(Examination::class, 'examinations')
                ]),
                Tab::make('Documents', [
                    HasMany::make(Document::class, 'documents')
                ]),
            ])
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new SendCustomerDocuments())
                ->confirmButtonText('Send')
                ->showOnTableRow()
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $data = $request->session()->all();

        Log::info("all session data:");
        Log::info(print_r($data, true));
        $outlet_id = $request->session()->get('outlet_id');

        Log::info("outlet_id from session: $outlet_id");
        # this is not outlet_id to be filter
        # this is just for demonstration purpose
        return $query->where('outlet_id', intval($outlet_id));
    }
}
