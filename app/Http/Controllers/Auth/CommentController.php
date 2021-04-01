<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Comment;

class CommentController extends Controller
{
    public function create(Request $request)
    {
         //validationを行う
        $this->validate($request, Comment::$rules);
        
        $comment = new Comment;
        $form = $request->all();
        
        //Authからuser_idを取り出す
        $comment->user_id = Auth::id();

        //フォームから送信されてきた_tokenを削除
        unset($form['_token']);

        
        //データベースに保存
        $comment->fill($form);
        $comment->save();
        
        return redirect()->back();
    }
        
}
