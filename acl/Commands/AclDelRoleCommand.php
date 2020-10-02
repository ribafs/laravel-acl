<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use DB;

class AclDelRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'del:role {email-user} {slug-role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Del role from user to Laravel ACL';

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
        $slug_role = $this->argument('slug-role');

        $role = Role::where('slug',$slug_role)->first();
        $user = User::where('email', $email_user)->first();

        $user->roles()->detach($role); // Esta role precisa existir em 'roles' para que seja adequadamente anexada
        $this->info(PHP_EOL);
        $this->info('Role excluida com sucesso do usuário '. $email_user.' Confira na tabela users '.PHP_EOL);
    }
}
