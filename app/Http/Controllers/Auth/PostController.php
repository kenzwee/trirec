<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Storage;


class PostController extends Controller
{
    public function index(Request $request)
    {   
        $cond_title = $request->cond_title;
        $type = $request->type;
        
        if($type == 'search'){
        //検索されたら検索結果を取得する 完全一致
            $posts = Post::where('title', 'like', "%$cond_title%")->orderBy('created_at', 'desc')->paginate(20);
        //Authは（）をつける　idメソッド
        }elseif($type == 'mypost'){
            $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->paginate(20);
        //各ユーザーのユーザーページで、そのユーザーの投稿一覧ボタンを押した時
        }elseif($type == 'userpage_post'){
            $posts = Post::where('user_id', ($request->id))->orderBy('created_at', 'desc')->paginate(20);

        }else {
        //検索しなかったそれ以外は全ての投稿を取得する
            $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        }
        
        return view('auth.post.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    

    public function add()
    {
        return view('auth.post.create');
    }
    
    public function create(Request $request)
    {
        $post_rules = array_merge(Post::$rules, Post::get_my_rules());
        
        $request->validate($post_rules);
        
        $post = new Post;
        $form = $request->all();
        
        if(isset($form['image'])){
        // $path = $request->file('image')->store('public/image');
        // $post->image_path = basename($path);
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $post->image_path = Storage::disk('s3')->url($path);
        } else {
            $photo->image_path = null;
        }     
        
        $post->user_id = Auth::id();
        
        unset($form['_token']);
        unset($form['image']);
        
        $post->fill($form);
        $post->save();
        
        return redirect('auth/post');
    }
    

    
    public function edit(Request $request)
    {
        $post = Post::find($request->id);
        if(empty($post)){
            abort(404);
        }
        
        return view('auth.post.edit', ['post_form' => $post]);
    }
    
    public function update(Request $request)
    {
        $post_update_rules = array_merge(Post::$updateRules, Post::get_my_rules());
        $this->validate($request, $post_update_rules);
        $post = Post::find($request->id);
        $post_form = $request->all();
        
        if($request->remove == 'ture'){
            $post_form['image_path'] = null;
        //画像が更新されたら
        }elseif($request->file('image')){
            // $path = $request->file('image')->store('public/image');
            // $post_form['image_path'] = basename($path);
            $path = Storage::disk('s3')->putFile('/',$post_form['image'],'public');
            $post_form['image_path'] = Storage::disk('s3')->url($path);
        }else{
        //画像は変わってない時
            $post_form['image_path'] = $post->image_path;
        }
        

        unset($post_form['image']);
        //削除というチェックボックスからチェックを外す（初期化してる）
        unset($post_form['remove']);
        unset($post_form['_token']);
        
        $post->fill($post_form)->save();
        
        $history = new History;
        $history ->post_id = $post->id;
        $history ->edited_at = Carbon::now();
        $history ->save();
        
        return redirect('auth/post/');
    }
    
    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();
        
        return redirect()->back();

    }
    
    public function search()
    {
        
        return view('auth/post/search');
    }
    
    public function result(Request $request)
    {
        $cond_title = $request->cond_title;
        $type = $request->type;
        $direction = $request->direction;
        
        if($type == 'search'){
        //検索されたら検索結果を取得する 完全一致
            $posts = Post::where('direction', $request->direction)->where('title', 'like', "%$cond_title%")->orderBy('created_at', 'desc')->paginate(20);
        }elseif($type == 'mypost'){
            $posts = Auth::user()->posts()->where('direction', $request->direction)->orderBy('created_at', 'desc')->paginate(20);

        }else{
            //検索しなかったそれ以外は全ての投稿を取得する
            $posts = Post::where('direction', $request->direction)->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('auth/post/search_result', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function show(Request $request)
    {
        $post = Post::find($request->id);
        if(empty($post)){
            abort(404);
        }

        $post->count++;
        $post->save();
        
        // post1件1件にコメントされたコメントを全て取得
        $comments = Comment::where('post_id', $request->id)->orderBy('created_at', 'desc')->paginate(20);
        
        return view('auth.post.detail', ['post' => $post, 'comments' => $comments]);
    }
}