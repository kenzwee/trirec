<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Item;


class ItemController extends Controller
{
    public function create(Request $request)
    {
        //validation
        $this->validate($request, Item::$rules);
        $items = new Item;

        $form = $request->all();
        //Authからuser_idを取り出す
        $items->user_id = Auth::id();
        
        unset($form['_token']);
        unset($form['trip_id']);
        unset($form['memo']);
        
        //データベースに保存
        $items->fill($form);
        $items->save();
        
        //detail.viewで送ったtrip_idを取り出し
        //allしてunsetする？
        // $trip = $request->trip_id;
        // $memo = $request->memo;
        

        // //attachメソッドで中間テーブルに保存
        // $items->trips()->attach($trip);
        // $items->attach($memo);
        
        $items->trips()->attach($request->trip_id, ["memo"=>$request->memo]);
        return redirect()->back();
    }

    
    public function delete(Request $request)
    {
        //該当するItemmodelを取得
        $items = Item::find($request->id);
        //削除する
        // $items->delete();
        $trip = $request->trip_id;
        $items->trips()->detach($trip);
        
        return redirect()->back();
    }
    
}
