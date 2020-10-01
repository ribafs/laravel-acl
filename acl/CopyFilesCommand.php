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
