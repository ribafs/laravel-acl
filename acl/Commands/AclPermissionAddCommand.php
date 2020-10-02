<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Permission;
use DB;

class AclPermissionAddCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:perm {name-perm} {slug-perm}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add permission to permissions table to Laravel 8 ACL';

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
        $name_perm = $this->argument('name-perm');
        $slug_perm = $this->argument('slug-perm');

        $perm = new Permission();
        $perm->name = $name_perm;
        $perm->slug = $slug_perm;
        $perm->save();

        $this->info(PHP_EOL);
        $this->info('Permissão adicionada com sucesso. Confira na tabela permissions '.PHP_EOL);
    }
}
