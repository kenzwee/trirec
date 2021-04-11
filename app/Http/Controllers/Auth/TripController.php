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
        //importanceで指定。
        $defaults = Item::where('importance','1')->get();
 
        return view('auth.trip.create', ['defaults' => $defaults]);
    }
    
    public function create(Request $request)
    {
        //validation
        $this->validate($request, Trip::$create_rules);
        
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
            $trip->items()->attach($item);
        }

        return redirect('auth/trip/index');   
        // return view('auth.trip.index');
    }
    
    public function show(Request $request)
    {   
        $trip = Trip::find($request->id);
        if(empty($trip)){
            abort(404);
        }

        return view('auth.trip.detail', ['trip' => $trip]);
    }
}
