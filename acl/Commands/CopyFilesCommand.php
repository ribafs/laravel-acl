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
        $seeder = base_path('database/seeders/DatabaseSeeder.php');
        if(File::exists($seeder)){
            File::copy($seeder, base_path('database/seeders/DatabaseSeederBAK.php'));
            File::copy(base_path('vendor/ribafs/laravel-acl/acl/seeders/DatabaseSeeder.php'), base_path('database/seeders/DatabaseSeeder.php'));
        }
        $route = base_path('routes/web.php');
        if(File::exists($route)){
            File::copy($route, base_path('routes/webBAK.php'));
            File::copy(base_path('vendor/ribafs/laravel-acl/acl/web.php'), base_path('routes/web.php'));
        }
        $user = app_path('Models/User.php');
        if(File::exists($user)){
            File::copy($user, app_path('Models/UserBAK.php'));
            File::copy(app_path('vendor/ribafs/laravel-acl/acl/User.php'), app_path('Models/User.php'));
        }
        $appp = app_path('Providers/AppServiceProvider.php');
        if(File::exists($appp)){
            File::copy($appp, app_path('Providers/AppServiceProviderBAK.php'));
            File::copy(app_path('vendor/ribafs/laravel-acl/acl/AppServiceProvider.php'), app_path('Providers/AppServiceProvider.php'));
        }
        $users = database_path('migrations/2014_10_12_000000_create_users_table.php');
        if(File::exists($users)){
            File::copy($users, database_path('migrations/2014_10_12_000000_create_users_tableBAK.php'));
            File::copy(database_path('vendor/ribafs/laravel-acl/acl/2014_10_12_000000_create_users_table.php'), database_path('migrations/2014_10_12_000000_create_users_table.php'));
        }
        $app = base_path('config/app.php');
        if(File::exists($app)){
            File::copy($app, base_path('config/appBAK.php'));
            File::copy(base_path('vendor/ribafs/laravel-acl/acl/app.php'), base_path('config/app.php'));
        }
        $kernel = app_path('Http/Kernel.php');
        if(File::exists($kernel)){
            File::copy($kernel, app_path('Http/kernelBAK.php'));
            File::copy(base_path('vendor/ribafs/laravel-acl/acl/Kernel.php'), app_path('Http/kernel.php'));
        }
        $wel = base_path('resources/views/welcome.blade.php');
        if(File::exists($wel)){
            File::copy($wel, base_path('resources/views/welcome.bladeBAK.php'));
            File::copy(base_path('vendor/ribafs/laravel-acl/acl/views/welcome.blade.php'), base_path('resources/views/welcome.blade.php'));
        }
        $app = base_path('resources/views/layouts/app.blade.php');
        if(File::exists($app)){
            File::copy($app, base_path('resources/views/layouts/app.bladeBAK.php'));
            File::copy(base_path('vendor/ribafs/laravel-acl/acl/views/layouts/app.blade.php'), base_path('resources/views/layouts/app.blade.php'));
        }

        $this->info(PHP_EOL);
        $this->info('Arquivos copiados com sucesso.'.PHP_EOL);
    }
}
