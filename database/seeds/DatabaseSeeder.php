<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(AppConfigSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TopicTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);

        // factory(App\Product::class, 100)
        //     ->create()
        //     ->each(function ($product) {
        //         $product->fees()->saveMany(factory(App\ProductFee::class, 3)->create([
        //             'product_id' => $product->id,
        //         ]));
        //     });
    }
}
