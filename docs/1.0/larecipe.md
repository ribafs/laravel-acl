## Larecipe

https://larecipe.binarytorch.com.my/

https://github.com/saleem-hadad/larecipe

https://laravel-news.com/larecipe-documentation-package

Este site foi criado usando o excelente pacote larecipe, que é usado para criar a documentação de aplicativos do laravel usando markdown.

## Instalação
```php
composer require binarytorch/larecipe
```
## Publicação

```php
php artisan larecipe:install
```

### O código ficará na pasta

resources/docs

### Vem por default com a versão 1.0 na pasta
resources/docs/1.0

### E esta é a pasta default ao chamar com

localhost:8000/docs

### Estrutura
```php
├─ config
│  └─ larecipe.php
└─ resources
   └─ docs
      │─ 1.0
      │  │─ index.md
      │  └─ overview.md
      └─ 2.0
         │─ index.md
         └─ overview.md
```

Podemos adicionar outras versões e mudar para que a nova versão seja a default, usando o config/larecipe.php

## Algumas configurações
```php
return [
    'docs'      => [
        'route'   => '/docs',
        'path'    => '/resources/docs',
        'landing' => 'overview',
        'middleware' => ['web']
    ]
];
```

### Tornando a versão 2.0 a default
```php
return [
    'versions'      => [
        'default'   => '2.0',
        'published' => [
            '1.0',
            '2.0'
        ]
    ]
];

```
