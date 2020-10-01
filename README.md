# Pacote com implementação de ACL no Laravel 8
Usando users, roles, permissions, trait, middleware, provider, etc

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]


### Recomenda-se criar um novo aplicativo com laravel 8 para testar o laravel-acl
Lembre que este pacote sobrescreve alguns arquivos, como o routes/web.php e o DatabaseSeeder.php

laravel new acl --jet --stack=livewire

no

cd acl


### Criar e configurar o banco
.env


## Instalar o laravel-acl
```bash
composer require ribafs/laravel-acl
```

## Publicar
```bash
php artisan vendor:publish --provider="Ribafs\LaravelAcl\LaravelAclServiceProvider"
```
Agora todos os arquivos do pacote já estão em seu aplicativo: migrations, seeders, Models, middleware, provider, etc

## Copiar alguns arquivos existentes
Como este pacote não sobrescreve arquivos existestes, então você precisará executar o comando copy:files (veja abaixo) para copiar sobrescrevendo os arquivos abaixo:

- DatabaseSeeder.php
- routes/web.php
- views/welcome.blade.php
- views/layouts/app.blade.php

O comando fará uma cópia de cada arquivo sobrescrito, adicionando BAK ao seu nome. Exemplo: routes/webBAK.php

### Executar
```bash
php artisan copy:files
```

## Configurar

### Registrar o middleware

Editar o app/Http/Kernel.php e adicionar ao array $routeMiddleware = [
```bash
        'role' => \Illuminate\Auth\Middleware\RoleMiddleware::class,
```

### Registrar o provider

Editar o config\app.php e adicione ao array 'providers' => [
```bash
        App\Providers\PermissionsServiceProvider::class,
```

### Editar o model app/Models/User.php e atualizar

```php
use App\Traits\HasPermissionsTrait;

class User extends Authenticatable
{
    use HasPermissionsTrait;
```

### Configurar o uso do bootstrap no laravel 8

Adicionar ao app/Providers/AppServiceProvider.php
```php
use Illuminate\Pagination\Paginator;

    public function boot()
    {
        Paginator::useBootstrap();
    }
```
### Alterar o campo id da migration users

Mudar para
```php
            $table->increments('id');
```
### Ajustar o título do aplicativo
Editar o .env e mudar a linha com APP_NAME, para algo como: APP_NAME='ACL to Laravel 8'


## Executar

Após adicionar seu CRUD, execute e teste o ACL no controle do acesso do seu aplicativo.
```bash
php artisan migrate --seed
php artisan serve
localhost:8000/login
```
Use como exemplo:

- super@gmail.com
- 123456

Depois teste com os demais: admin, manager e user


## Adicionar novos usuários

Lembrando que deve evitar inserir usuários manualmente.
Para isso foi criado um command, que insere o usuário e anexa uma role e uma permission para o mesmo. Por enquanto tem uma limitação. Anexa somente uma role e uma permissão.
```bash
php artisan add:user
```

# Testar após o login

## Acessar com super@gmail.com e 123456

Observe que ele é redirecionado para users

Veja que seu menu aparece com todos os CRUDs e ele tem acesso a tudo, todos as views de todos os CRUDs


## Acessar com admin@gmail.com e 123456

Observe que ele é redirecionado para users

Veja que seu menu aparecem users, roles e permissions, ou seja, administrativos. Acessa estes 3 CRUDs e ele tem acesso a tudo deles mas não acessa clients nem products.


### Experimente acessar

http://localhost:8000/admin/clients

http://localhost:8000/admin/products


## Acessar com manager@gmail.com e 123456

Observe que ele é redirecionado para clients

Veja que seu menu aparecem clients e products, ou seja, os de negócio. Acessa estes 2 CRUDs e ele tem acesso a tudo deles mas não acessa users, roles nem permissions.


### Experimente acessar

http://localhost:8000/admin/users

http://localhost:8000/admin/roles

http://localhost:8000/admin/permissions

http://localhost:8000/admin/permissions/1/edit


## Acessar com user@gmail.com e 123456

Observe que ele é redirecionado para clients

Veja que é o usuário mais restrito, em seu menu aparece somente clients. Acessa clients e ele tem acesso somente a parte de clients/index.


### Experimente acessar qualquer outra área, por exemplo:

http://localhost:8000/admin/roles
http://localhost:8000/admin/clients/1/edit
http://localhost:8000/admin/clients/show/1


## Customizar este aplicativo

Os CRUDs existentes neste pacote foram criados usando o pacote ribafs/crud-generator-acl

https://github.com/ribafs/crud-generator-acl

Este pacote foi criado partindo do ribafs/crud-generator. O c ribafs/crud-generator é um fork do excelente
https://github.com/appzcoder/crud-generator

Esse pacote facilita muito nosso trabalho, pois foi criado para complementar o trabalho do pacote laravel-acl. Já vem com muitos e bons recursos. Verifique no site e experimente.


## Instalar e publicar o crud-generator-acl
```bash
composer require ribafs/crud-generator-acl

php artisan vendor:publish --provider="Ribafs\CrudGeneratorAcl\CrudGeneratorServiceProvider"
```

## Criar o CRUD Products (exemplo)
```bash
php artisan crud-acl:generate Products --fields='name#string; price#decimal' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --route-group=admin --form-helper=html
```

## Após a criação do CRUD faça os ajustes

- Remover a migration users criada acima pelo gerador, visto que já temos uma migration customizada. 
- Renomear o controller de ProductsController para ProductControler (singular, de acordo com a convenção do alravel). 
- Mudar o nome do controller na rota criada pelo gerador para o singular.


## Adicionar/alterar
- users
- roles
- permissions

Podemos adicionar novos usuários, remover existentes ou idealmente renomeá-los e trocar seus dados. Mas algumas alterações requerem alterações correspondentes no seeder Permissions, com código similar ao existente.

Caso adicione um usuário, precisa adicioná-lo para uma role e precisa adicionar permissions paa ele, mas tudo isso pelo PermissionsSeeder, para que sejam cadastrados os respectivos dados nas tabels pivô. Caso adicione manualmente precisará adicionar também nas tabelas pivô, que não é interessante nem seguro.


## Alerta

Precisamos ficar atentos para as atualizações do alravel, quando precisaremos ajustar nosso aplicativo devidamente.


## Erros que podem ocorrer

### Call to undefined method App\Models\User::roles()
- Este indica que o trait ainda não foi configurado no model User (vide configurações)

### Caso a tela apareça quebrada, com os botões abaixo
- Indica que falta configurar o middleware (ver configurações)

    
## Credits

- [author name][link-author]
- [All Contributors][link-contributors]


## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/ribafs/laravel8acl.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ribafs/laravel8acl.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ribafs/laravel8-acl
[link-downloads]: https://packagist.org/packages/ribafs/laravel8-acl and https://github.com/ribafs/laravel8-acl
[link-author]: https://github.com/ribafs and https://ribafs.github.io
'
