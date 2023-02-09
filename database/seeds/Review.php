<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class Review extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 16; $i ++)
        {

            DB::table('reviews')->insert([
                'member_id' => 31,
                'product_id' => 1,
                'evaluation' => random_int(1,5),
                'comment' => 'comment' . $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
