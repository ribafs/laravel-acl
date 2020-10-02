# Provider

A definição das tags customizadas do blade surgiu no provider abaixo

### Usando nas blades

```blade
@role
@endrole
```
Que deverão ser usadas nas blades

### Para uso nos controllers e routes temos:
```php
- super:role
- admin:role
- etc
```
## Nosso provider

```php
<?php
namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{   
    public function register()
    {
        //
    }

    public function boot()
    {
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->slug, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        //Blade directives
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) : ?>";
        });

        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });
    }
}
```

## Para proteger as rotas

Testar o middleware com
```php
- role:super
- role:admin
- etc

Route::group(['middleware' => 'role:super'], function() {
   Route::get('/super', 'App\Http\Controllers\TesteController@super');
});
```

## Outro exemplo
```php
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $super = (Auth::user()->hasRole('super'));
    $admin = (Auth::user()->hasRole('admin'));
    $manager = (Auth::user()->hasRole('manager'));
    $user = (Auth::user()->hasRole('user'));

    if($super) {
        return redirect('super/users');
    }elseif($admin) {
        return redirect('admin/users');
    }elseif($manager) {
        return redirect('manager/clients');
    }elseif($user) {
        return redirect('user/clients');
    }

    return view('dashboard');
})->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::group(['middleware' => ['role:super'], 'prefix' => 'super'], function () { 
            Route::resource('users', 'App\Http\Controllers\UserController'); // super/users
            Route::resource('roles', 'App\Http\Controllers\RoleController'); // super/roles
            Route::resource('permissions', 'App\Http\Controllers\PermissionController'); // super/permissions
            Route::resource('clients', 'App\Http\Controllers\ClientController'); // super/clients
            Route::resource('products', 'App\Http\Controllers\ProductController'); // super/products
    });
    Route::group(['middleware' => ['role:admin'], 'prefix' => 'admin'], function () {
            Route::resource('users', 'App\Http\Controllers\UserController');
            Route::resource('roles', 'App\Http\Controllers\RoleController');
            Route::resource('permissions', 'App\Http\Controllers\PermissionController');
    });
    Route::group(['middleware' => ['role:manager'], 'prefix' => 'manager'], function () {
            Route::resource('clients', 'App\Http\Controllers\ClientController');
            Route::resource('products', 'App\Http\Controllers\ProductController');
    });
    Route::group(['middleware' => ['role:user'], 'prefix' => 'user'], function () {
            Route::resource('clients', 'App\Http\Controllers\ClientController');
    });
});
```

