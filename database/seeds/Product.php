<?php

use Illuminate\Database\Seeder;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++)
        {
            DB::table('products')->insert([
                'member_id' => 1,
                'product_category_id' => 1,
                'product_subcategory_id' => 4,
                'name' => 'ベッド' . $i,
                'product_content' => 'コンテンツ' . $i,
            ]);
        }
    }
}
