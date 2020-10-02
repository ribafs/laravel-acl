# Introdução

---

- [Seção Inicial](#section-1)

<a name="section-1"></a>
## Seção Inicial

Projeto de implementação de ACL em aplicativos do Laravel from Scratch

Usando Users, Roles, Permissions, Provider, Middleware, Trait, Gates, etc

Observação: este projeto é fruto de várias pesquisas pela internet e de alguns experimentos meus

Conta com duas versões
- laravel-acl - para o laravel 8
- laravel7-acl - para o laravel 7


## Planejamento inicial

Teremos as seguintes tabelas principais
```php
users
roles
permissions
clients
```
### Teremos os seguintes usuários
```php
1-Super
2-Admin
3-Manager
4-User
```
### As roles
```php
1-super
2-admin
3-manager
4-user
```
### As permissões
```php
1-all-all
2-users-all
3-roles-all
4-permissions-all
5-clients-all
6-products-all
7-clients-index
```
### Tabelas pivô

As roles e permissions serão atribuidas aos usuários via código e não diretamente. Elas serão armazenadas nas tabelas pivô:
- user_role
- user_permission
- role_permission

### Gerenciamento via artisan

Esta tarefa é inicialmente realizada pelo PermissionsSeeder, mas após a instalação users, roles e permissions podem ser gerenciados por commandos com artisan.


