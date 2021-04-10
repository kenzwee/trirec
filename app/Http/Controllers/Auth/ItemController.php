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
        
        unset($form['_token']);

        //データベースに保存
        $items->fill($form);
        $items->save();
        
        return redirect()->back();
    }
    

    
    
    
    
    public function delete(Request $request)
    {
        //該当するItemmodelを取得
        $items = Item::find($request->id);
        //削除する
        $items->delete();
        
        return redirect()->back();
    }
    
}
