<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Trip;


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

        return view('auth.trip.create');
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

        //データベースに保存する
        $trip->fill($form);
        $trip->save();

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
