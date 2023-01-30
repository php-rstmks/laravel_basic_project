<?php

use Illuminate\Database\Seeder;

class Review extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 8; $i ++)
        {

            DB::table('reviews')->insert([
                'member_id' => 1,
                'product_id' => 36,
                'evaluation' => random_int(1,5),
                'comment' => 'comment' . $i,
            ]);
        }
    }
}
