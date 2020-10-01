<?php
namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionsTrait {

   public function roles() {
      return $this->belongsToMany(Role::class,'user_role');

   }

   public function permissions() {
      return $this->belongsToMany(Permission::class,'user_permission');

   }

    // Parâmetros: role. Ex: $user->hasRole('admin')
    // Checar se o user atual detem a role especificada
    // Retorno: true/false
   public function hasRole( ... $roles ) {
       foreach ($roles as $role) {
       if ($this->roles->contains('slug', $role)) {
             return true;
          }
       }
       return false;
    }

    protected function hasPermission($permission) {
       return (bool) $this->permissions->where('slug', $permission)->count();
    }

    // Parâmetro: permission. $user->hasPermissionThroughRole('clients-index'). As permissões devem estar em 'permisions'
    // Checar se o user atual detem a permission citada
    // Retorno true/false
    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role){
          if($this->roles->contains($role)) {
            return true;
          }
        }
        return false;
    }

    // Parâmetro: permission. $user->hasPermissionTo('clients-index'). As permissões devem estar em 'permisions'
    // Checar se o user atual detem a permission citada
    // $user->hasPermissionTo('clients-index'). As permissões devem estar em 'permisions' e a função retorna true ou false
    // Retorno true/false
    public function hasPermissionTo($permission) {
       return (bool) $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    protected function getAllPermissions(array $permissions) {
        return Permission::whereIn('slug',$permissions)->get();    
    }

    // Parâmetros: permissions. Ex: $user->givePermissionsTo('clients-index','clients-edit')// as permissões já devem estar em 'permissions'
    // Grava permissões para o user atual, na tabela user_permission
    // Sem retorno. Grava as permissões na tabela user_permission para o user atual
    public function givePermissionsTo(... $permissions) {
       $permissions = $this->getAllPermissions($permissions);
//       dd($permissions);
       if($permissions === null) {
          return $this;
       }
       $this->permissions()->saveMany($permissions);
       return $this;
    }

    // Remove uma ou mais permissões do user atual, que estão em user_permission
    // Parãmetros: permissions. Ex: $user->deletePermissions('clients-index', 'clients-edit')
    // Sem retorno. Grava as informações na tabela e mostra na tela dados do suer atual
    public function deletePermissions( ... $permissions ) {
       $permissions = $this->getAllPermissions($permissions);
       $this->permissions()->detach($permissions);
       return $this;
    }

}
