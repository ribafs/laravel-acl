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
        $route = base_path('routes/web.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/web.php'), $route);

        $user = app_path('Models/User.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/User.php'), $user);

        $wel = base_path('resources/views/welcome.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/views/welcome.blade.php'), $wel);

        $appb = resources_path('views/layouts/app.blade.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/views/app.blade.php'), $appb);

        $appp = app_path('Providers/AppServiceProvider.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/AppServiceProvider.php'), $appp);

        $app = base_path('config/app.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/app.php'), $app);

        $kernel = app_path('Http/Kernel.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/Kernel.php'), $kernel);

        $seeder = database_path('seeders/DatabaseSeeder.php');
        File::copy(base_path('vendor/ribafs/laravel-acl/acl/DatabaseSeeder.php'), $seeder);

        $this->info(PHP_EOL);
        $this->info('Arquivos copiados com sucesso.'.PHP_EOL);
    }
}
