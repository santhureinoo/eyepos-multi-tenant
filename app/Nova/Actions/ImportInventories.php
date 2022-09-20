<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;

use App\Imports\InventoriesImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportInventories extends Action
{
    use InteractsWithQueue, Queueable;

    // /**
    //  * Indicates if this action is only available on the resource index view.
    //  *
    //  * @var bool
    //  */
    // public $onlyOnIndex = true;

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = true;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Import Inventories');
    }

    /**
     * @return string
     */
    public function uriKey(): string
    {
        return 'import-inventories';
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        Excel::import(new InventoriesImport, $fields->file);
        return Action::message('It worked!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            File::make('File')
                ->rules('required'),
        ];
    }
}
