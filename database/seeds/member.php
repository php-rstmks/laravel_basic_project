<?php

use Illuminate\Database\Seeder;
use Hash;

class Member extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 1; $i++)
        {
            DB::table('members')->insert([
                'name_sei' => 'henoheno',
                'name_mei' => $i,
                'nickname' => 'nickname',
                'gender' => random_int(0,1),
                'password' => Hash::make(11111111),
                'email' => 'test@' . $i . 'test',
            ]);
        }
    }
}
