<?php

use Illuminate\Database\Seeder;

class Member extends Seeder
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
            DB::table('members')->insert([
                'name_sei' => 'henoheno',
                'name_mei' => $i,
                'nickname' => 'nickname',
                'gender' => random_int(0,1),
                'password' => 11111111,
                'email' => 'test@' . $i . 'test',
            ]);
        }
    }
}
