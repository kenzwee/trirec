<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class profiles_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            [
                'username'              => 'Taro',
                'user_id'               => '1',
                'introduction'          => '初めまして山田太郎です。',
                'want_to_travel_world'  => 'アメリカ',
                'traveled_world'        => '台湾、中国',
                'want_to_travel_japan'  => '広島',
                'traveled_japan'        => '東京',
                'image_path'            => 'null',
                'remember_token'        => Str::random(10),
            ],
            [
                'username'              => 'Hanako',
                'user_id'               => '2',
                'introduction'          => '初めまして山田太郎です。',
                'want_to_travel_world'  => 'インド',
                'traveled_world'        => 'アメリカ',
                'want_to_travel_japan'  => '北海道',
                'traveled_japan'        => '大阪',
                'image_path'            => 'null',
                'remember_token'        => Str::random(10),
            ],
        ]);  
    }
}
