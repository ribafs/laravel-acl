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
        // Files to overwrite here. Only copy in provider
        $route = base_path('routes/web.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/up/web.php'), $route);

        $user = app_path('Models/User.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/up/User.php'), $user);

        File::copy(base_path('vendor/ribafs/laravel-acl/up/welcome.blade.php'), base_path('resources/views/welcome.blade.php'));

        $appb = base_path('resources/views/layouts/app.blade.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/up/app.blade.php'), $appb);

        $prov = app_path('Providers/AppServiceProvider.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/up/AppServiceProvider.php'), $prov);

        $app = base_path('config/app.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/up/app.php'), $app);

        $kernel = app_path('Http/Kernel.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/up/Kernel.php'), $kernel);

        $seeder = database_path('seeders/DatabaseSeeder.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/up/DatabaseSeeder.php'), $seeder);

        $this->info(PHP_EOL);
        $this->info('Arquivos copiados com sucesso.'.PHP_EOL);
    }
}
