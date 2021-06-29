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
                'image_path'    =>'northamerica_seed.jpg',
                'title'         =>'アメリカの大荒野',
                'body'          =>'先日アメリカに行って来ました！グランドサークル凄すぎる！',
                'created_at'    => date('2021-3-27 15:01:59'),
                'updated_at'    => date('2021-3-27 15:02:50'),
            ],
            [
                'user_id'       =>'1',
                'direction'     =>'south_america',
                'image_path'    =>'southamerica_seed.jpg',
                'title'         =>'マチュピチュの古代遺跡',
                'body'          =>'念願のマチュピチュ！晴天で良かった〜',
                'created_at' => date('2021-3-26 15:01:59'),
                'updated_at' => date('2021-3-26 15:02:50'),
            ],
            [
                'user_id'       =>'2',
                'direction'     =>'asia',
                'image_path'    =>'asia_seed.jpg',
                'title'         =>'暁の寺',
                'body'          =>'ボートに乗り行くワットアルン',
                'created_at' => date('2021-3-25 15:01:59'),
                'updated_at' => date('2021-3-25 15:02:50'),

            ],
            [
                'user_id'       =>'1',
                'direction'     =>'europe',
                'image_path'    =>'europe_seed.jpg',
                'title'         =>'ノイシュヴァンシュタイン城',
                'body'          =>'雪降る中に佇む城。ディズニのお城のモデルとか。。。',
                'created_at' => date('2021-3-24 15:01:59'),
                'updated_at' => date('2021-3-24 15:02:50'),
            ],
            [
                'user_id'       =>'1',
                'direction'     =>'africa',
                'image_path'    =>'africa_seed.jpg',
                'title'         =>'本当のサファリ体験',
                'body'          =>'遭遇率５％のキリンに会えました！',
                'created_at' => date('2021-3-23 15:01:59'),
                'updated_at' => date('2021-3-23 15:02:50'),
            ],
            [
                'user_id'       =>'1',
                'direction'     =>'middle_east',
                'image_path'    =>'middleeast_seed.jpg',
                'title'         =>'ドバイの夜景はgood',
                'body'          =>'世界４大夜景にした方がいいのでは！？',
                'created_at' => date('2021-3-20 15:01:59'),
                'updated_at' => date('2021-3-20 15:02:50'),
            ],
            [
                'user_id'       =>'2',
                'direction'     =>'oceania',
                'image_path'    =>'oecania_seed.jpg',
                'title'         =>'greatな海！',
                'body'          =>'グレートバリアリーフ綺麗すぎん？',
                'created_at' => date('2021-3-20 15:01:59'),
                'updated_at' => date('2021-3-20 15:02:50'),
            ],
        ]);
    }
}
