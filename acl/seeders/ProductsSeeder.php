<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB; 

class ProductsSeeder extends Seeder
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
            DB::table('products')
                ->insert([
                'name'      => $faker->name,
                'price'      => $faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 100),
                ]);
        endfor;
    }
}
