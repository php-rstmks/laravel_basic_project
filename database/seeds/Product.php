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
        for($i = 1; $i <= 3; $i++)
        {
            $random_int = random_int(16,20);

            $a_int = $i + 28;
            DB::table('products')->insert([
                'member_id' => 1,
                'product_category_id' => 4,
                'product_subcategory_id' => $random_int,
                'name' => 'アイテム' . $a_int,
                'product_content' => 'コンテンツ' . $a_int,
            ]);
        }
    }
}
