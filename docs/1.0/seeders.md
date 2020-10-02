# Seeders

Este pacote vem com dois seeders: clients e permissions

## Clients

```php
<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB; 

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i<=100; $i++):
            DB::table('clients')
                ->insert([
                'name'      => $faker->name,
                'email'      => $faker->email,
                ]);
        endfor;
    }
}
```

## Permissions

O PermissionsSeeder é o coração do pacote laravel-acl. Ele faz o cadastro inicial das tabelas principais e pivô. O cadastro das tabelas pivô é feito indiretamente usando o método attach().

Seu código é bem grande, portanto indico que você cheque no repositório.

