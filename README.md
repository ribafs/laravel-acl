# ACL implementation in Laravel 9

## Portuguese version this README

[README-PT](README-PT.md)

## Support to laravel 9

Using users, roles, permissions, trait, middleware, provider, etc

## How to works?
User 'super' has access to all tables and can do everything in each one.
User 'admin' only has access to the permissions, roles and users tables and can do everything with them.
User 'manager' only has access to the customer table and can do everything with it.
The 'user' user has access only to the clients' index view.

Log in with each user to try it out.

## Tested with

- Windows 7 and 10
- Linux Mint 20 and 21

## News in version 2.0

Now we have two areas, public and administrative. When entering the root of the application, you will be able to access the list of clients and the show. After login you will have rights according to the user.

## Create a new app named 'acl' in laravel 9

If you have laravel installer, use:

```bash
laravel new acl --jet --teams --stack=livewire
cd acl
npm install && npm run dev
```
If not, use:
```
composer create-project --prefer-dist laravel/laravel acl "9.5.2"
cd acl
composer require laravel/jetstream
php artisan jetstream:install livewire
npm install && npm run dev
```

### Create and configure the database

nano .env


## Install the laravel-acl

```bash
composer require ribafs/laravel-acl
```

## Publishe

```bash
php artisan vendor:publish --provider="Ribafs\LaravelAcl\LaravelAclServiceProvider"
```
## Copy some existing files

- DatabaseSeeder.php
- routes/web.php
- views/welcome.blade.php
- views/layouts/app.blade.php

### Copy files

```bash
php artisan copy:files
```
Now all package files are already in your application: migrations, seeders, Models, middleware, provider, etc

### Adjust app title (optional)

Edit the .env and change the line with APP_NAME, to something like: APP_NAME='ACL to Laravel 9'

## Try

After adding your CRUD, run and test the ACL on your application's access control.

```bash
php artisan migrate --seed
php artisan serve
localhost:8000/login
```

## If you receive the error

```
Target class [Fruitcake\Cors\HandleCors] does not ...
```

Then edit

app/Http/Kernel.php

And comment out the line:

        //\Fruitcake\Cors\HandleCors::class,

Use to test:

- super@mail.org
- 123456

Then test with the others: admin, manager and user

## Important

This package is intended for new applications. Avoid using it in existing applications as it may overwrite some files.

## Documentation in more detail

The information above and much more information on how to get the most out of this package (English only for now):

[https://ribafs.github.io/laravel-acl](https://ribafs.github.io/laravel-acl)

## How to creating a demo app with ribafs/laravel-acl

Create a permission that no user has (example)

```bash
all-no

php artisan add:perm 'No perms' all-no 
```

And assign to all views I don't want access to

```bash
@can('all-no')
```
On actions

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
Restrict actions to only those that have all-no permission, which no user has.

So you don't need to change the views.

## Version for laravel 8 with existing apps

If you want a package to use with version 7 of laravel, click below:

[https://github.com/ribafs/laravel-acl-exist](https://github.com/ribafs/laravel-acl-exist)

## Version for laravel 7

If you want a package to use with version 7 of laravel, click below:

[https://github.com/ribafs/laravel7-acl](https://github.com/ribafs/laravel7-acl)

## Version for laravel 6

If you want a package to use with laravel version 6, click below:

[https://github.com/ribafs/laravel6-acl](https://github.com/ribafs/laravel6-acl)

## Version for Laravel 5.8

If you want a package to use with laravel version 5.8, click below:

[https://github.com/ribafs/laravel58-acl](https://github.com/ribafs/laravel58-acl)

To quickly exchange ideas

https://github.com/ribafs/laravel-acl/discussions/

## License

MIT
