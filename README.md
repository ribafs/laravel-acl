# Implementação de ACL no Laravel 8
Usando users, roles, permissions, trait, middleware, provider, etc

## Testado em
- Windows 7
- Linux Mint 20

## Novidade da versão 2.0

Agora temos duas áreas, pública e administrativa. Ao entrar no raiz do aplicativo poderá acessar a listagem de clients e o show. Após o login terá direitos de acordo com o usuário.

## Criar um novo aplicativo com com nome 'acl' no laravel 8
```bash
laravel new acl --jet --teams --stack=livewire
cd acl
npm install && npm run dev
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

- super@mail.org
- 123456

Depois teste com os demais: admin, manager e user

## Importante

Este pacote é indicado para novos aplicativos. Evite usá-lo em aplicativos existentes, pois ele pode sobrescrever alguns arquivos.

## Documentação com mais detalhes

As informações acima e muito mais informações de como tirar o máximo proveito deste pacote:

[https://ribafs.github.io/laravel-acl](https://ribafs.github.io/laravel-acl)

## Criação de um app demo com ribafs/laravel-acl

Criar uma permissão que nenhum user tem (exemplo)
```bash
all-no

php artisan add:perm 'No perms' all-no 
```

E atribuir para todas as views que não desejo acesso
```bash
@can('all-no')
```
Nos actions
```bash
    public function create(Request $request)
    {
        if ($request->user()->can('all-no')) {
            return view('admin.clients.create');
        }else{
            print '<a href="#" onClick="window.history.back();">Back to app</a>';
            return '<h3 align="center">Access denied in this demo</h3>';
        }
    }
```
Restringir nos actions para somente os que tem a permissão all-no, que nenhum user tem.

Assim não precisa mexer nas views.

## Versão para laravel 8 com aplicativos existentes

Se deseja um pacote para usar com a versão 7 do laravel, clique abaixo:

[https://github.com/ribafs/laravel-acl-exist](https://github.com/ribafs/laravel-acl-exist)

## Versão para laravel 7

Se deseja um pacote para usar com a versão 7 do laravel, clique abaixo:

[https://github.com/ribafs/laravel7-acl](https://github.com/ribafs/laravel7-acl)

## Versão para laravel 6

Se deseja um pacote para usar com a versão 6 do laravel, clique abaixo:

[https://github.com/ribafs/laravel6-acl](https://github.com/ribafs/laravel6-acl)

## Versão para o Laravel 5.8

Se deseja um pacote para usar com a versão 5.8 do laravel, clique abaixo:

[https://github.com/ribafs/laravel58-acl](https://github.com/ribafs/laravel58-acl)

## License

MIT

