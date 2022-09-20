<?php

namespace App\Console\Commands;

use App\Models\Customer\Visit;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckEyeHealthReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:eyehealth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // TODO: Customize Period
        $now    = Carbon::now()->format('y-m-d');
        $visits = Visit::whereDate('created_at', $now)->get();

        foreach ($visits as $visit) {
            \App\Events\CheckEyeHealthReminder::dispatch($visit);
        }
    }
}
