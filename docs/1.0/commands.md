## Gerenciando ACL via Artisan

Lembrando que deve evitar anexar roles e permissions manualmente para usuários.

Para isso foram criados alguns commands, que gerencial de forma adequada.

```php
Adicionar user com role e permission anexada a ele
add:user {name} {email} {password} {slug-role} {slug-perm}

Exemplo:
php artisan add:user 'User user2' user2@gmail.com 123456 manager clients-index

Atualizar usuário existente anexando uma role e uma permission a ele, gravado em user_role 
e user_permission
user:upd {email} {slug-role} {slug-perm}

Exemplo:
php artisan user:upd manager@gmail.com manager clients-index

Adicionar uma role para a tabela roles
add:role {name-role} {slug-role}

Exemplo:
php artisan add:role 'Admin test' admin-test 

Adicionar uma permission para a tabela permissions
add:perm {name-perm} {slug-perm}

Exemplo:
php artisan add:perm 'Clients test' clients-testt 

Remover permission de user de 'user-permission'
del:perm {email-user} {slug-perm}

Exemplo:
php artisan del:perm super@gmail.com clients-index

Remover role de user de 'user_role'
del:role {email-user} {slug-role}

Exemplo:
php artisan del:role super@gmail.com user
```

