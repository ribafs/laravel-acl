<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use DB;

class AclRoleAddCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:role {name-role} {slug-role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add role to roles table to Laravel 8 ACL';

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
        $name_role = $this->argument('name-role');
        $slug_role = $this->argument('slug-role');

        $role = new Role();
        $role->name = $name_role;
        $role->slug = $slug_role;
        $role->save();

        $this->info(PHP_EOL);
        $this->info('Role adicionada com sucesso. Confira na tabela permissions '.PHP_EOL);
    }
}
