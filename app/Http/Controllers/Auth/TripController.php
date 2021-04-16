<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Trip;
use App\Item;


class TripController extends Controller
{
    public function index(Request $request)
    {   
        $cond_title = $request->title;
    
        $type = $request->type;

        if($type == 'search'){
            $trips = Trip::where('title', $cond_title);
        }else{
            // $trip = Trip::where('user_id', Auth::id())->get();
            $trips = Auth::user()->trips;
        }
        


        return view('auth.trip.index',['trips' => $trips, 'cond_title' => $cond_title]);
    }
    
    public function add()
    {   
        //importanceで指定
        //defaltのseeder登録したやつ＋重要度２も表示
        $defaults = Item::where('importance','1')->orWhere('importance', '2')->get();
        
        return view('auth.trip.create', ['defaults' => $defaults]);
    }
    
    public function create(Request $request)
    {
        //validation
        $this->validate($request, Trip::$create_rules);
        //送られてきたデータを下記の様に確認
        // dd($request->item_id);
        
        $trip = new Trip;
        $form = $request->all();
        //Authからuser_idを取り出す
        $trip->user_id = Auth::id();
        
        //フォームから送信されてきたtokenを削除
        unset($form['_token']);
        
        //item_idを消す
        unset($form['item_id']);
        
        //データベースに保存する
        $trip->fill($form);
        $trip->save();
        
        //create.viewで送ったidを取り出し、foreachで回す
        //配列でデータが送られてくる為
        foreach($request->item_id as $item){
            //attachメソッドで中間テーブルに保存
            //全く同じカラムがitemテーブルに出来ない様にsync
            $trip->items()->attach($item);
        }

        return redirect('auth/trip/index');   
        // return view('auth.trip.index');
    }
    
    public function edit(Request $request)
    {
        $trip = Trip::find($request->id);
        return view('auth.trip.edit', ['trip' => $trip]);
    }
    
    
    public function update(Request $request)
    {
        //validationをかける ::→クラス変数を呼び出し
        $this->validate($request, Item::$rules, Trip::$create_rules);
        //Tripモデルから該当するidのデータを取得
        $trip = Trip::find($request->id);
        
        //edit.viewでitem（goodsやimportance）が配列で送られてくる為、for文で送られてきた配列数分だけでループする
        for($i=0; $i< count($request->item_ids); $i++){
            $item = Item::find($request->item_ids[$i]);
            $item->goods = $request->goods[$i];
            $item->importance = $request->importance[$i];
            $item->save();
            //updateExistingPivotで第一引数はどの中間テーブルのidを更新したいのか教えてあげる必要がある為、
            //$trip->id(更新したい$item_idと関連付いている$trip_id)を指定、第二引数は何のデータを上書きしたいか
            //syncでも更新可能（今回は全てのitemを更新しているから）
            //trip_id = 1をsyncで更新しても、trip_id = 2は更新されない（上書きされない）
            $item->trips()->updateExistingPivot($trip->id, ["memo"=>$request->memo[$i]]);
            

        }
       

        //送信されてきたフォームデータを格納
        $form = $request->all();
        unset($form['_token']);
        unset($form['importance']);
        unset($form['goods']);
        unset($form['item_ids']);
        unset($form['memo']);

        $trip->fill($form)->save();

        return redirect()->back();

        
    }
    
    public function show(Request $request)
    {   
        $trip = Trip::find($request->id);
        if(empty($trip)){
            abort(404);
        }
        
        // $items = Trip::find($request->id)->items();
        // $a = $trip->items();
        // $trip->memoItems()->toSql();
        // $memos = $trip->items->pivot->memo;
     
        // foreach($trip->items as $item){
        //     $trip->items()->pivot->memo;
        // }
        

        // foreach ($trip->items as $item) {
        //     $a =  $item->pivot->memo;
        // }
 
        
        // $trip->items()->wherePivotIn('memo', [$request->trip_id, $request->item_id]);
        
        return view('auth.trip.detail', ['trip' => $trip]);
    }
}
