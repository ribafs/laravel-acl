<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use DB;

class AclUserUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:upd {email} {slug-role} {slug-perm}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user to Laravel ACL, attach role and permission';

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
        $email = $this->argument('email');
        $slug_role = $this->argument('slug-role');
        $slug_perm = $this->argument('slug-perm');

        $role = Role::where('slug',$slug_role)->first();
        $perm = Permission::where('slug',$slug_perm)->first();
        $user = User::where('email', $email)->first();

        $user->roles()->attach($role); // Esta role precisa existir em 'roles' para que seja adequadamente anexada
        $user->permissions()->attach($perm); // Esta permissão precisa existir em 'permissions' para que seja adequadamente anexada
        $this->info(PHP_EOL);
        $this->info('Roles e permissions do Usuário  '. $email_user.' atualizadas com sucesso. Confira na tabela users '.PHP_EOL);
    }
}
