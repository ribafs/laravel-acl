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
