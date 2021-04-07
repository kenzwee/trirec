<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {   

        return view('auth.item.index');
    }
    
    public function add()
    {   

        return view('auth.item.create');
    }
    
    public function create(Request $request)
    {
        //validation
        $this->validate($request, Item::$create_rules);
        

        $item = new Item;
        $form = $request->all();
        
        //Authからuser_idを取り出す
        $item->user_id = Auth::id();
        
        //フォームから送信されてきたtokenを削除
        unset($form['_token']);

        //データベースに保存する
        $item->fill($form);
        $item->save();
        
        return view('auth.item.index');
    }
    
    public function show(Request $request)
    {   

        return view('auth.item.detail');
    }
}
