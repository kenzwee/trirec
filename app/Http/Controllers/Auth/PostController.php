<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use App\Post;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request)
    {   
        $cond_title = $request->cond_title;
        $type = $request->type;
        
        if($type == 'search'){
            //検索されたら検索結果を取得する 完全一致
            $posts = Post::where('title', 'like', "%$cond_title%")->orderBy('updated_at', 'desc')->paginate(20);
        //Authは（）をつける　idメソッド
        }elseif($type == 'mypost'){
            $posts = Auth::user()->posts()->orderBy('updated_at', 'desc')->paginate(4);
            // $posts = Post::where('user_id', Auth::id())->paginate(4);
            
        }else {
            //検索しなかったそれ以外は全ての投稿を取得する
            $posts = Post::orderBy('updated_at', 'desc')->paginate(4);
        }
        


    
        return view('auth.post.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    

    public function add()
    {
        return view('auth.post.create');
    }
    
    public function create(Request $request)
    {
        //validationを行う
        $this->validate($request, Post::$rules);
        
        $post = new Post;
        $form = $request->all();
        
        //フォームから画像が送信されてきたら、保存して$post->image_pathに画像のパスを保存する
        if(isset($form['image'])){
        $path = $request->file('image')->store('public/image');
        $post->image_path = basename($path);
        } else {
            $photo->image_path = null;
        }     
        
        //Authからuser_idを取り出す
        $post->user_id = Auth::id();
        
        //フォームから送信されてきた_tokenを削除
        unset($form['_token']);
        //フォームから送信されてきたimageを削除
        unset($form['image']);
        
        //データベースに保存
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
        //validationをかける ::→クラス変数を呼び出し
        $this->validate($request, Post::$updateRules);
        //Post modelからデータを取得
        $post = Post::find($request->id);
        //送信されてきたフォームデータを格納
        $post_form = $request->all();
        
        //画像を削除した場合はimage_pathも削除する
        if($request->remove == 'ture'){
            $post_form['image_path'] = null;
        //画像が更新されたら。。
        }elseif($request->file('image')){
            //上はpublic/imageに画像を保存
            //下はファイル名からpathを作成して(左辺)、image_pathに（右辺に）代入
            $path = $request->file('image')->store('public/image');
            $post_form['image_path'] = basename($path);
        }else{
            //画像は変わってない時
            $post_form['image_path'] = $post->image_path;
        }
        
        unset($post_form['image']);
        //削除というチェックボックスからチェックを外す（初期化してる）
        unset($post_form['remove']);
        unset($post_form['_token']);
        
        //該当するデータを上書き保存
        $post->fill($post_form)->save();
        
        $history = new History;
        $history ->post_id = $post->id;
        $history ->edited_at = Carbon::now();
        $history ->save();
        
        return redirect('auth/post/');
    }
    
    public function delete(Request $request)
    {
        //該当するPostmodelを取得
        $post = Post::find($request->id);
        //削除する
        $post->delete();
        return redirect('auth/post/');
    }
    
    public function search()
    {
        
        return view('auth/post/search');
    }
    
    public function result(Request $request)
    {   //第一引数は検索したいカラム名、第二引数（第三）は第一引数のカラム名に対する値
        //$postsはコレクションインスタンス
        $posts = Post::where('direction', $request->direction)->get();
        
        return view('auth/post/search_result', ['posts' => $posts]);
    }
    
    public function show(Request $request)
    {
        $post = Post::find($request->id);
        if(empty($post)){
            abort(404);
        }

        $post->count++;
        $post->save();
        // $post->fill($post_form)->save();
        return view('auth.post.detail', ['post' => $post]);
    }
}