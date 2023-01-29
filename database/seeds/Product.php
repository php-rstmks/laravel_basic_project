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
        for($i = 1; $i <= 50; $i++)
        {
            $random_int_for1 = random_int(1,5);
            $random_int_for2 = random_int(6,10);
            $random_int_for3 = random_int(11,15);
            $random_int_for4 = random_int(16,20);

            $a_int = $i + 1;
            $b_int = $i + 10;
            $c_int = $i + 20;
            $d_int = $i + 50;
            DB::table('products')->insert([
                'member_id' => 1,
                'product_category_id' => 1,
                'product_subcategory_id' => $random_int_for1,
                'name' => 'アイテム' . $d_int,
                'product_content' => 'コンテンツ' . $d_int,
            ]);

            // DB::table('products')->insert([
            //     'member_id' => 1,
            //     'product_category_id' => 2,
            //     'product_subcategory_id' => $random_int_for2,
            //     'name' => 'アイテム' . $b_int,
            //     'product_content' => 'コンテンツ' . $b_int,
            // ]);

            // DB::table('products')->insert([
            //     'member_id' => 1,
            //     'product_category_id' => 3,
            //     'product_subcategory_id' => $random_int_for3,
            //     'name' => 'アイテム' . $c_int,
            //     'product_content' => 'コンテンツ' . $c_int,
            // ]);
            // DB::table('products')->insert([
            //     'member_id' => 1,
            //     'product_category_id' => 4,
            //     'product_subcategory_id' => $random_int_for4,
            //     'name' => 'アイテム' . $d_int,
            //     'product_content' => 'コンテンツ' . $d_int,
            // ]);
        }
    }
}
