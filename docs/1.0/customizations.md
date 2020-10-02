## Customizando

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

