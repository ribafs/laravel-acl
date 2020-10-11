<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Permission;
use DB;

class AclDelPermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'del:perm {email-user} {slug-perm}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Del eprmissioon from user to Laravel ACL';

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
        $email_user = $this->argument('email-user');
        $slug_perm = $this->argument('slug-perm');

        $perm = Permission::where('slug',$slug_perm)->first();
        $user = User::where('email', $email_user)->first();

        $user->permissions()->detach($perm); // Esta permissão precisa existir em 'permissions' para que seja adequadamente anexada
        $this->info(PHP_EOL);
        $this->info('Permissão com sucesso. Confira na tabela users '.PHP_EOL);
    }
}
