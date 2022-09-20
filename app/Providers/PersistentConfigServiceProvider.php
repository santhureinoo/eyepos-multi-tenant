<?php

namespace App\Providers;

use Illuminatech\Config\Providers\AbstractPersistentConfigServiceProvider;
use Illuminatech\Config\StorageContract;
use Illuminatech\Config\StorageDb;

class PersistentConfigServiceProvider extends AbstractPersistentConfigServiceProvider
{
    protected function items(): array
    {
        return [
            'app.name'                     => [
                'label' => 'Practice Name',
                'rules' => ['sometimes', 'required'],
            ],
            'app.timezone'                 => [
                'label'   => 'Default Timezone',
                'rules'   => ['sometimes', 'required'],
                'options' => [
                    'options' => config('setup.timezone'),
                ]
            ],
            'setup.financials.currency'    => [
                'label'   => 'Default Currency',
                'rules'   => ['sometimes', 'required'],
                'options' => [
                    'options' => config('setup.financials.currencies')
                ]
            ],
            'setup.financials.gst'         => [
                'label' => 'Default Goods & Services Tax (GST)',
                'rules' => ['sometimes', 'required'],
            ],
            'prescription.default_version' => [
                'label'   => 'Prescription Chart',
                'rules'   => ['sometimes', 'required'],
                'options' => [
                    'options' => [
                        ['value' => 'version_1', 'label' => '6/6'],
                        ['value' => 'version_2', 'label' => '20/20'],
                    ],
                ],
            ],
        ];
    }

    protected function storage(): StorageContract
    {
        return (new StorageDb($this->app->make('db.connection')));
    }
}
