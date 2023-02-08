<?php

use Illuminate\Database\Seeder;
// use Hash;
use Illuminate\Support\Carbon;

class Member extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 16; $i <= 45; $i++)
        {
            DB::table('members')->insert([
                'name_sei' => 'henoheno',
                'name_mei' => $i,
                'nickname' => 'nickname',
                'gender' => random_int(1,2),
                'password' => Hash::make(11111111),
                'email' => 'test@' . $i . 'test',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);


        }
        
        DB::table('administers')->insert([
            'name' => 'admin1',
            'login_id' => 'admin1',
            'password' => 'Hash::make(11111111)',
        ]);
    }
}
