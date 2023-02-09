<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class ProductCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            'name' => 'インテリア'
        ]);
        DB::table('product_categories')->insert([
            'name' => '家電'
        ]);
        DB::table('product_categories')->insert([
            'name' => 'ファッション'
        ]);
        DB::table('product_categories')->insert([
            'name' => '美容'
        ]);
        DB::table('product_categories')->insert([
            'name' => '本・雑誌'
        ]);

        for ($i = 1; $i < 40; $i++)
        {
            DB::table('product_categories')->insert([
                'name' => 'かてゴリ' . $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
