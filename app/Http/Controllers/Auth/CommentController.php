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
        
        $this->validate($request, Comment::$rules, Comment::$messages);
        
        $comments = new Comment;
        $form = $request->all();
        $comments->user_id = Auth::id();

        unset($form['_token']);

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
        $this->validate($request, Comment::$rules, Comment::$messages);
        $comment = Comment::find($request->id);

        $comment_form = $request->all();
        
        unset($comment_form['_token']);
        
        $comment->fill($comment_form)->save();
        
        return redirect()->route('post_detail', ['id' => $comment->post_id]);

    }
    
    public function delete(Request $request)
    {        
        $comments = Comment::find($request->id);
        $comments->delete();
        
        return redirect()->back();
    }
        
}
