<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Item;
use App\Trip;
use App\ItemTrip;


class ItemController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, Item::$rules);
        $items = new Item;

        $form = $request->all();
        $items->user_id = Auth::id();
        
        unset($form['_token']);
        unset($form['trip_id']);
        unset($form['memo']);
        
        $items->fill($form);
        $items->save();
        
        //attachメソッドで中間テーブルに保存
        $items->trips()->attach($request->trip_id, ["memo"=>$request->memo]);
        
        return redirect()->back();
    }

    
    public function delete(Request $request)
    {
        $items = Item::find($request->id);
        $trip = $request->trip_id;
        $items->trips()->detach($trip);
        
        return redirect()->back();
    }
    
    public function alldelete(Request $request)
    
    {
        $trip = Trip::find($request->id);
        $trip->items()->detach();

        return redirect()->back();
    }
    
}
