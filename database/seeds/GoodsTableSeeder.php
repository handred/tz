<?php

use App\Good;
use Faker\Factory;
use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Good::truncate();

        $faker = Factory::create();

        //protected $fillable = ['name', 'price', 'amount', 'description'];
        //
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Good::create([
                'name' => $faker->sentence,
                'description' => $faker->paragraph,
                'price' => rand(1000, 100000),
                'amount' => rand(1, 1000),
            ]);
        }
    }

}
