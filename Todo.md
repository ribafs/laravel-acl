# Recursos que podem melhorar o laravel-acl

CRUDs para as tabelas:

user_role
user_permission

Criar CRUDs

Anexar roles para users

user_role

user_email
roles_slug
$user->giveRolesTo($roles_slug)

Anexar permissions para users num CRUD

user_permission

Ter um form com
user_email
permissions_slug
$user->giveRolesTo(permissions_slug)

Remover roles de users

user_email
roles_slug
$user->deleteRoles($roles_slug)

Remover permissions de users

user_email
permissions_slug
$user->deleteRoles($permissions_slug)

