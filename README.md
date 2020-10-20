# Implementação de ACL no Laravel 8
Usando users, roles, permissions, trait, middleware, provider, etc

## Testado em
- Windows 7
- Linux Mint 20

## Criar um novo aplicativo com laravel 8
```bash
laravel new acl --jet --stack=livewire
```
Tecle enter quando aparecer [no]
```bash
cd acl
```

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
## Copiar alguns arquivos existentes

- DatabaseSeeder.php
- routes/web.php
- views/welcome.blade.php
- views/layouts/app.blade.php

### Copiar arquivos
```bash
php artisan copy:files
```
Agora todos os arquivos do pacote já estão em seu aplicativo: migrations, seeders, Models, middleware, provider, etc

### Ajustar o título do aplicativo (opcional)
Editar o .env e mudar a linha com APP_NAME, para algo como: APP_NAME='ACL to Laravel 8'

## Testar

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

## Documentação com mais detalhes

As informações acima e muito mais informações de como tirar o máximo proveito deste pacote:

[https://ribafs.github.io/laravel-acl](https://ribafs.github.io/laravel-acl)

## Licença

## Versão para laravel 7

Se deseja um pacote para usar com a versão 7 do laravel, clique abaixo:

[https://github.com/ribafs/laravel7-acl](https://github.com/ribafs/laravel7-acl)

## Versão para laravel 6

Se deseja um pacote para usar com a versão 6 do laravel, clique abaixo:

[https://github.com/ribafs/laravel6-acl](https://github.com/ribafs/laravel6-acl)

## Versão para o Laravel 5.8

Se deseja um pacote para usar com a versão 5.8 do laravel, clique abaixo:

[https://github.com/ribafs/laravel58-acl](https://github.com/ribafs/laravel58-acl)


## Demo online

Caso queira ver um demom de aplicativo usando o pacote ribafs/laravel-acl, acesse:

http://159.89.22.33/laravel/public/

=======
MIT
>>>>>>> 5f3c2aa6f649fd9b29c0e2a3466509dc5c309fb0
