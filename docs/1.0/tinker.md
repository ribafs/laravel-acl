# Usando o Tinker

Usando o Tinker para gerenciar a ACL

A maioria das funções do trait podem ser usadas via tinker para o gerenciamento do controle de acesso.

## Exemplos

### Checar se user logado tem uma das roles: admin ou super
Verificará na tabela user_role

```php
php artisan tinker
$user = User::find(1) // Trazer o user com id 1, no nosso caso o Super user
$user->hasRole('admin', 'super')
```

No caso deve retornar true

### Criar uma nova role
Que ficará'na tabela 'roles'
```php
$user->createRole('Role teste', 'teste')
```
Mostrará a role criada na tela e a gravará na tabela 'roles'

### Atribuir uma ou mais role para o user atual
Será gravado na tabela user_role. Lembre que somente serão atribuidas se as roles esxistirem em 'roles'

```php
php artisan tinker
$user = User::find(3) // Trazer o user com id 3, no nosso caso o Manager user
$user->giveRolesTo('editor','author')
```
Não atribuiu nenhuma, pois as roles citadas não existem em 'roles'.

### Novo teste
```php
php artisan tinker
$user = User::find(3) // Trazer o user com id 3, no nosso caso o Manager user
$user->giveRolesTo('user')
```
Agora sim, atribuiu, pois a role 'user' existe. Veja em user_role.

### Desatribuir uma role de um usuário

```php
php artisan tinker
$user = User::find(3) // Trazer o user com id 3, no nosso caso o Manager user
$user->deleteRoles('user')
```
Veja em 'user_role'

## Temos no trait funções semelhantes para permissions

