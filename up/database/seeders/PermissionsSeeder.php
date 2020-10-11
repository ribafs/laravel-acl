<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Consultar e guardar em $super_permission a permissão all-all e demais
        $super_permission = Permission::where('slug','all-all')->first();
        $admin_permission1 = Permission::where('slug','users-all')->first();
        $admin_permission2 = Permission::where('slug','roles-all')->first();
        $admin_permission3 = Permission::where('slug','permissions-all')->first();
        $manager_permission1 = Permission::where('slug', 'clients-all')->first();
        $manager_permission2 = Permission::where('slug', 'products-all')->first();
        $user_permission = Permission::where('slug', 'clients-index')->first();

        // Cadastrar a role super e anexar a ela suas permissões
        $super_role = new Role();
        $super_role->slug = 'super';
        $super_role->name = 'Super role';
        $super_role->save();
        $super_role->permissions()->attach($super_permission); // para que esta permission seja anexada sem problema, precisa existir em 'permissions'

        // Cadastrar a role admin e anexar a ela suas permissões
        $admin_role = new Role();
        $admin_role->slug = 'admin';
        $admin_role->name = 'Admin role';
        $admin_role->save();
        $admin_role->permissions()->attach($admin_permission1);
        $admin_role->permissions()->attach($admin_permission2);
        $admin_role->permissions()->attach($admin_permission3);

        // Cadastrar a role manager e anexar a ela suas permissões
        $manager_role = new Role();
        $manager_role->slug = 'manager';
        $manager_role->name = 'Manager role';
        $manager_role->save();
        $manager_role->permissions()->attach($manager_permission1);
        $manager_role->permissions()->attach($manager_permission2);

        // Cadastrar a role user e anexar a ela suas permissões
        $user_role = new Role();
        $user_role->slug = 'user';
        $user_role->name = 'Uer role';
        $user_role->save();
        $user_role->permissions()->attach($user_permission);

        // Consultar e guardar em $super_role a role super e demais
        $super_role = Role::where('slug','super')->first();
        $admin_role = Role::where('slug','admin')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $user_role = Role::where('slug','user')->first();

        // Cadastrar no banco a permission all-all e anexar sua(a) respectiva(s) role(s)
        $all_all = new Permission();
        $all_all->slug = 'all-all';
        $all_all->name = 'All permissions';
        $all_all->save();
        $all_all->roles()->attach($super_role); // para que esta role seja anexada sem problema, precisa existir em 'roles'

        // Cadastrar no banco a permission user-all e anexar sua(a) respectiva(s) role(s)
        $users_all = new Permission();
        $users_all->slug = 'users-all';
        $users_all->name = 'Users all';
        $users_all->save();
        $users_all->roles()->attach($admin_role);

        // Cadastrar no banco a permission roles-all e anexar sua(a) respectiva(s) role(s)
        $roles_all = new Permission();
        $roles_all->slug = 'roles-all';
        $roles_all->name = 'Roless all';
        $roles_all->save();
        $roles_all->roles()->attach($admin_role);

        // Cadastrar no banco a permission permissions-all e anexar sua(a) respectiva(s) role(s)
        $permissions_all = new Permission();
        $permissions_all->slug = 'permissions-all';
        $permissions_all->name = 'Permissions all';
        $permissions_all->save();
        $permissions_all->roles()->attach($admin_role);

        // Cadastrar no banco a permission clients-all e anexar sua(a) respectiva(s) role(s)
        $clients_all = new Permission();
        $clients_all->slug = 'clients-all';
        $clients_all->name = 'Clients all';
        $clients_all->save();
        $clients_all->roles()->attach($manager_role);

        // Cadastrar no banco a permission products-all e anexar sua(a) respectiva(s) role(s)
        $products_all = new Permission();
        $products_all->slug = 'products-all';
        $products_all->name = 'Products all';
        $products_all->save();
        $products_all->roles()->attach($manager_role);

        // Cadastrar no banco a permission clients-all e anexar sua(a) respectiva(s) role(s)
        $clients_index = new Permission();
        $clients_index->slug = 'clients-index';
        $clients_index->name = 'Clients index';
        $clients_index->save();
        $clients_index->roles()->attach($user_role);

        // Consultar e guardar em $super_role a role super
        $super_role = Role::where('slug','super')->first();
        $admin_role = Role::where('slug','admin')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $user_role = Role::where('slug', 'user')->first();

        // Consultar e guardar em $super_perm a permissão all-all e demais
        $super_perm = Permission::where('slug','all-all')->first();
        $admin_perm1 = Permission::where('slug','users-all')->first();
        $admin_perm2 = Permission::where('slug','roles-all')->first();
        $admin_perm3 = Permission::where('slug','permissions-all')->first();
        $manager_perm1 = Permission::where('slug','clients-all')->first();
        $manager_perm2 = Permission::where('slug','products-all')->first();
        $user_perm = Permission::where('slug','clients-index')->first();

        // Cadastrar o user Super no banco e anexar a ele sua(s) respectiva(s) role(s) e permission(s)
        $super = new User();
        $super->name = 'Super user';
        $super->email = 'super@gmail.com';
        $super->password = bcrypt('123456');
        $super->save();
        $super->roles()->attach($super_role); // Esta role precisa existir em 'roles' para que seja adequadamente anexada
        $super->permissions()->attach($super_perm); // Esta role precisa existir em 'permissions' para que seja adequadamente anexada

        // Cadastrar o user Admin no banco e anexar a ele sua(s) respectiva(s) role(s) e permission(s)
        $admin = new User();
        $admin->name = 'Admin user';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('123456');
        $admin->save();
        $admin->roles()->attach($admin_role);
        $admin->permissions()->attach($admin_perm1);
        $admin->permissions()->attach($admin_perm2);
        $admin->permissions()->attach($admin_perm3);

        // Cadastrar o user Manager no banco e anexar a ele sua(s) respectiva(s) role(s) e permission(s)
        $manager = new User();
        $manager->name = 'Manager user';
        $manager->email = 'manager@gmail.com';
        $manager->password = bcrypt('123456');
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm1);
        $manager->permissions()->attach($manager_perm2);
 
        // Cadastrar o user User no banco e anexar a ele sua(s) respectiva(s) role(s) e permission(s)
        $user = new User();
        $user->name = 'User user';
        $user->email = 'user@gmail.com';
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($user_role);
        $user->permissions()->attach($user_perm);
       
        //return redirect()->back();
    }
}
