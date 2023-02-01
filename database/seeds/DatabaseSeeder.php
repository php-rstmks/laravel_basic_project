<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductCategories::class);
        $this->call(ProductSubcategories::class);
        $this->call(Product::class);
        // $this->call(Review::class);
    }
}
