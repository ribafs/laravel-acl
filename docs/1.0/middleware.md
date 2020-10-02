# Middleware RoleMiddleware

Este é o middleware usado.

```php
<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $permission = null)

    {
        if(!$request->user()->hasRole($role)) {
             abort(404);

        }

        if($permission !== null && !$request->user()->can($permission)) {
              abort(404);
        }

        return $next($request);
    }
}
```
## Método can($permission)

Aqui nasce nosso método can($permission), que pode ser usado nos actions dos controller, para controlar o acesso pelo slug da permission


## Usando

Testar de o usuário logado pode usar a permissão all-all
```php
    public function index(Request $request){
        if ($request->user()->can('all-all')) {
            return 'Seja muito bem vindo seu Super';
        }
    }
```

