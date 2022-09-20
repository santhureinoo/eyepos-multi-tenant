<?php

namespace App\Nova\Customer;

use App\Nova\Resource;
use DigitalCreative\ConditionalContainer\ConditionalContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Document extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Customer\Document::class;

    /**
     * Show resource in navigation bar.
     */
    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'file_name';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        $date = $this->created_at;

        return ucwords(preg_replace('/[_]+/', ' ', $this->category)) . ' (' . date('d-m-Y', strtotime($date)) . ')';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'category',
        'file_name'
    ];

    /**
     * Return the location to redirect the user after creation.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Laravel\Nova\Resource                  $resource
     *
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/customers/' . $resource->customer->id . '?tab=documents';
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Laravel\Nova\Resource                  $resource
     *
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/customers/' . $resource->customer->id . '?tab=documents';
    }

    /**
     * Return the location to redirect the user after deletion.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return string|null
     */
    public static function redirectAfterDelete(NovaRequest $request)
    {
        return '/resources/customers';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Customer'),
            Select::make('Category')
                ->options([
                    'acuity_eye_test'     => 'Acuity Test',
                    'refraction_eye_test' => 'Refraction Eye Test',
                    'field_test'          => 'Field Test',
                    'slit-lamp_exam'      => 'Slit-lamp Exam',
                    'glaucoma_test'       => 'Glaucoma Test',
                    'color_blind_test'    => 'Color blind Test',
                    'retinoscopy'         => 'Retinoscopy'
                ])->displayUsing(function ($category) {
                    return ucwords(preg_replace('/[_]+/', ' ', $category));
                }),
            BelongsTo::make('Examinations')
                ->nullable()
                ->displayUsing(function ($examination) {
                    return date('d-m-Y H:m', strtotime($examination->created_at)) . ' (' . ucfirst($examination->category) . ')';
                }),
            Text::make('Notes'),
            File::make('File Name', 'file_name')
                ->disk('s3')
                ->storeSize('file_size')
                ->thumbnail(function ($value, $disk) {
                    return $value
                        ? Storage::disk($disk)->url($value)
                        : null;
                }),

            Text::make('File Size')
                ->exceptOnForms()
                ->displayUsing(function ($value) {
                    return number_format($value / 1024, 2) . 'kb';
                }),

            DateTime::make('Last Modified', 'updated_at')
                ->exceptOnForms()
                ->default(function ($request) {
                    return Carbon::now()->format('d-m-Y H:M');
                }),
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
        return [];
    }
}
