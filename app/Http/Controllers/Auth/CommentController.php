<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Comment;
use App\Http\Controllers\Auth\Post;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        
         //validationを行う
        $this->validate($request, Comment::$rules, Comment::$messages);
        
        $comments = new Comment;
        
        $form = $request->all();
        //Authからuser_idを取り出す
        $comments->user_id = Auth::id();

        //フォームから送信されてきた_tokenを削除
        unset($form['_token']);

        
        //データベースに保存

        $comments->fill($form);
        $comments->save();
        
        return redirect()->back();

    }
    
    public function edit(Request $request)
    {
        $comments = Comment::find($request->id);
        if(empty($comments)){
            abort(404);
        }
            
        return view('auth.comment.edit', ['comment_form'=>$comments]);
    }
    
    public function update(Request $request)
    {
        //validationをかける ::→クラス変数を呼び出し
        $this->validate($request, Comment::$rules, Comment::$messages);
        //Comment modelからデータを取得
        $comment = Comment::find($request->id);

        //送信されてきたフォームデータを格納
        $comment_form = $request->all();
        
        unset($comment_form['_token']);
        
        //該当するデータを上書き保存
        $comment->fill($comment_form)->save();
        

        return redirect()->route('post_detail', ['id' => $comment->post_id]);

    }
    
    public function delete(Request $request)
    {        
        //該当するCommentmodelを取得
        $comments = Comment::find($request->id);
        //削除する
        $comments->delete();
        
        return redirect()->back();
    }
        
}
