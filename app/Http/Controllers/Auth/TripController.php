<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Trip;
use App\Item;
use App\ItemTrip;


class TripController extends Controller
{
    public function index(Request $request)
    {   
        $cond_title = $request->trip_title;
    
        $type = $request->type;
        
        //検索された場合
        if($type == 'search'){
            $trips = Auth::user()->trips()->where('trip_title', 'like', "%$cond_title%")->orderBy('trip_start', 'asc')->orderBy('trip_end', 'asc')->paginate(10);
            
        //検索されてない場合
        }else{
            $trips = Auth::user()->trips()->orderBy('trip_start', 'asc')->orderBy('trip_end', 'asc')->paginate(10);
            
        }
        

        return view('auth.trip.index',['trips' => $trips, 'cond_title' => $cond_title]);
    }
    
    public function add()
    {   
        //defaltのseeder登録したやつ＋重要度２も表示
        $defaults = Item::where('importance','1')->orWhere('importance', '2')->get();
        
        return view('auth.trip.create', ['defaults' => $defaults]);
    }
    
    public function create(Request $request)
    {
        $create_rules = array(
        'trip_title' => 'required|max:20',
        'trip_start' => 'required|after_or_equal:' . date('Y/m/d'),
        'trip_end' => 'required|after_or_equal:trip_start'
        );
        
        $this->validate($request, $create_rules);

        $trip = new Trip;
        $form = $request->all();
        $trip->user_id = Auth::id();
        
        unset($form['_token']);
        unset($form['item_id']);
        
        $trip->fill($form);
        $trip->save();
        
        
        //tripをcreateする時点でseederのitemを選択しなかった時に対するif文
        if(empty($request->item_id) == false){
            foreach($request->item_id as $item){
            //attachメソッドで中間テーブルに保存
            //全く同じカラムがitemテーブルに出来ない様にsync
            $trip->items()->attach($item);
            }
        }

        return redirect('auth/trip/index');   
    }
    
    public function edit(Request $request)
    {
        $trip = Trip::find($request->id);
        $items = $trip->items()->orderBy('importance', 'asc')->get();

        return view('auth.trip.edit', ['trip' => $trip , 'items' => $items]);
    }
    
    
    public function update(Request $request)
    {
        $create_rules = array(
        'trip_title' => 'required|max:20',
        'trip_start' => 'required|after_or_equal:' . date('Y/m/d'),
        'trip_end' => 'required|after_or_equal:trip_start'
        );
        
        $trip_update_rules = array_merge(Item::$rules, $create_rules, ['memo' => 'max:20']);
            
        $this->validate($request, $trip_update_rules);
        $trip = Trip::find($request->id);
        
        //edit.viewでitem（goodsやimportance）が配列で送られてくる為、for文で送られてきた配列数分だけでループする
        for($i=0; $i< count($request->item_ids); $i++){
            $item = Item::find($request->item_ids[$i]);
            $item->goods = $request->goods[$i];
            $item->importance = $request->importance[$i];
            $item->save();

            $item->trips()->updateExistingPivot($trip->id, ["memo"=>$request->memo[$i]]);
            
        }
       
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
        
        $items = $trip->items()->orderBy('importance', 'asc')->get();
        
        
        return view('auth.trip.detail', ['trip' => $trip, 'items' => $items]);
    }
    
    public function delete(Request $request)
    {
        $trip = Trip::find($request->id);

        $trip->items()->detach();
        $trip->delete();

        return redirect('auth/trip/index');
    }
}
