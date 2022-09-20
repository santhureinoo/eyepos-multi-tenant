<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Commands/MigrationInOrder.php \n Drop all the table in db before execute the command.';

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
        $migrations = [
            '2022_09_19_163149_create_companies_table.php',
            '2022_09_19_163212_create_outlets_table.php',
            '2014_10_12_000000_create_users_table.php',

            '2014_10_12_100000_create_password_resets_table.php',
            '2018_01_01_000000_create_action_events_table.php',
            '2018_10_10_000000_create_configs_table.php',

            '2019_05_10_000000_add_fields_to_action_events_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php',
            '2019_12_14_000001_create_personal_access_tokens_table.php',

            '2021_12_05_122054_create_customers_table.php',
            '2021_12_09_034027_create_inventories_table.php',
            '2021_12_09_044115_create_referrals_table.php',
            '2021_12_09_045605_create_orders_table.php',
            '2021_12_09_164414_customer_order.php',

            '2021_12_09_165618_inventory_order.php',
            '2021_12_09_170342_inventory_suppliers.php',
            '2021_12_09_171346_inventory_brands.php',

            '2021_12_09_172436_create_inventory_categories_table.php',
            '2022_01_13_053522_create_customer_visits_table.php',
            '2022_01_13_062654_create_customer_documents_table.php',
            '2022_01_13_062710_create_customer_examinations_table.php',

            '2022_02_01_170441_create_customer_intake_questionnaires_table.php',
            '2022_02_11_190453_create_customer_satisfaction_table.php',
            '2022_02_16_182015_create_service_offers_table.php',

            '2022_03_06_192324_create_visions_table.php',
            '2022_05_29_014511_create_gates_table.php',
            '2022_09_12_140515_create_sessions_table.php',
        ];

        foreach($migrations as $migration) {
            $basePath = 'database/migrations/';
            $migrationName = trim($migration);
            $path = $basePath . $migrationName;

            $this->call('migrate', [
                '--path' => $path,
            ]);
        }
    }
}
