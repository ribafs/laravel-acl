# Instalação do laravel-acl

## Crie um novo aplicativo com laravel 8 para testar o pacote

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
### Ajustar o título do aplicativo (opcional)
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
