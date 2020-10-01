<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyFilesCommand extends Command
{
    protected $signature = 'copy:files';

    protected $description = 'Copy files from package laravel8acl to this application';

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
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/seeders/DatabaseSeeder.php'), base_path('database/seeders/DatabaseSeeder.php'));
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/web.php'), base_path('routes/web.php'));

        $this->info(PHP_EOL);
        $this->info('Routes e DatabaseSeeder copiados com sucesso.'.PHP_EOL);
    }
}
