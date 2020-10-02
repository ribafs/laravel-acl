## Testando o ACL

Testando o controle de acesso ao aplicativo, nas rotas, controllers e views.

### Acessar com super@gmail.com e 123456

Observe que ele é redirecionado para users

Veja que seu menu aparece com todos os CRUDs e ele tem acesso a tudo, todos as views de todos os CRUDs


### Acessar com admin@gmail.com e 123456

Observe que ele é redirecionado para users

Veja que seu menu aparecem users, roles e permissions, ou seja, administrativos. Acessa estes 3 CRUDs e ele tem acesso a tudo deles mas não acessa clients nem products.


### Experimente acessar

http://localhost:8000/admin/clients

http://localhost:8000/admin/products


### Acessar com manager@gmail.com e 123456

Observe que ele é redirecionado para clients

Veja que seu menu aparecem clients e products, ou seja, os de negócio. Acessa estes 2 CRUDs e ele tem acesso a tudo deles mas não acessa users, roles nem permissions.


### Experimente acessar

http://localhost:8000/admin/users

http://localhost:8000/admin/roles

http://localhost:8000/admin/permissions

http://localhost:8000/admin/permissions/1/edit


### Acessar com user@gmail.com e 123456

Observe que ele é redirecionado para clients

Veja que é o usuário mais restrito, em seu menu aparece somente clients. Acessa clients e ele tem acesso somente a parte de clients/index.


### Experimente acessar qualquer outra área, por exemplo:

http://localhost:8000/admin/roles
http://localhost:8000/admin/clients/1/edit
http://localhost:8000/admin/clients/show/1

