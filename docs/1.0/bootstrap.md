## Bootstrap

Configurando o laravel 8 para usar bootstrap

Para continuar usando bootstrap adicione ao ...

```php
app/Providers/AppServiceProvider.php

use Illuminate\Pagination\Paginator;
```
No método boot
```php
        Paginator::useBootstrap();
```

