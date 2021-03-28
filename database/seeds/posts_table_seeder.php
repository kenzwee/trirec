<?php

use Illuminate\Database\Seeder;

class posts_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id'       =>'1',
                'direction'     =>'north_america',
                'image_path'    =>'sample.png',
                'title'         =>'アメリカの大荒野',
                'body'          =>'先日アメリカに行って来ました！グランドサークル凄すぎる！',
                'created_at' => date('2021-3-27 15:01:59'),
                'updated_at' => date('2021-3-27 15:02:50'),
            ],
            [
                'user_id'       =>'1',
                'direction'     =>'south_america',
                'image_path'    =>'sample.png',
                'title'         =>'マチュピチュの古代遺跡',
                'body'          =>'念願のマチュピチュ！晴天で良かった〜',
                'created_at' => date('2021-3-26 15:01:59'),
                'updated_at' => date('2021-3-26 15:02:50'),
            ],
            [
                'user_id'       =>'2',
                'direction'     =>'north_america',
                'image_path'    =>'sample.png',
                'title'         =>'ラスベガスで大博打',
                'body'          =>'ラスベガスで全財産をカジノに注ぎ込みました！',
                'created_at' => date('2021-3-25 15:01:59'),
                'updated_at' => date('2021-3-25 15:02:50'),

            ],
            [
                'user_id'       =>'1',
                'direction'     =>'north_america',
                'image_path'    =>'sample.png',
                'title'         =>'ロサンゼルスでショッピング',
                'body'          =>'サンタモニカからのビバリーヒルズで爆買いしたわ',
                'created_at' => date('2021-3-24 15:01:59'),
                'updated_at' => date('2021-3-24 15:02:50'),
            ],
            [
                'user_id'       =>'1',
                'direction'     =>'north_america',
                'image_path'    =>'sample.png',
                'title'         =>'眠らない街ラスベガス',
                'body'          =>'ラスベガスで朝から晩まで観光三昧',
                'created_at' => date('2021-3-23 15:01:59'),
                'updated_at' => date('2021-3-23 15:02:50'),
            ],
            [
                'user_id'       =>'1',
                'direction'     =>'north_america',
                'image_path'    =>'sample.png',
                'title'         =>'サンタモニカでサーフィン',
                'body'          =>'知らないアメリカ人とサーフィンしました〜',
                'created_at' => date('2021-3-20 15:01:59'),
                'updated_at' => date('2021-3-20 15:02:50'),
            ],
        ]);
    }
}
