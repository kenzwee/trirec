<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Redis;

class Ranking extends Controller
{
    //keyの保存、閲覧数のインクリメント　閲覧のあった記事のidを引数として受け取り閲覧数の管理
    public function increment_view_ranking($id)
    {
        //valueを取得
        $key = "ranking-"."id:".$id;
        //Redis::get()でvalueの取得
        $value = Redis::get($key);

        if(empty($value)){
            Redis::set($key, "1");
            Redis::expire($key, 3600*24); 
        } else {
            Redis::set($key, $value + 1);
        }
    }
    
    //ランキング結果を配列で取得
    public function get_ranking_all()
    {
        //Redis::keys('ranking-*')でkeyの取得　*でワイルドカードの指定
        $keys = Redis::keys('ranking-*');
        $results = Array();

        if(empty($keys) != true){
            for($i = 0; $i < sizeof($keys); $i++){
                $id = explode(':', $keys[$i])[1];
                $point = Redis::get('ranking-id:'. $id);
                $results[$id] = $point;
            }
            //arsortでvalueの降順にソート
            arsort($results, SORT_NUMERIC);
        }
        return $results;
    }
}
