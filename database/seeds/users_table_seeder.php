<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usersテーブルに登録させるレコード
        DB::table('users')->insert([
            [
                'name'      => '山田太郎',
                'email'     => 'taro@yahoo.co.jp',
                'password'  => Hash::make('testtest'),
                'remember_token' => Str::random(10),
            ],
            [
                'name'      => '山田花子',
                'email'     => 'hanako@yahoo.co.jp',
                'password'  => Hash::make('testtest'),
                'remember_token' => Str::random(10),                
            ],
        ]);
    }
}
