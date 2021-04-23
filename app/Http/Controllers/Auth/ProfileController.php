<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Rules\AddImageRule;


class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.profile.index');
    }
    
    public function show(Request $request)
    {
        $profile = Profile::find($request->id);

        // $profile = $request->all();

        //Profile modelから現在ログインしているユーザーの画像データを取得
        // $profile = Profile::find(Auth::id());
        
        //resourcesのviews以下のファイル：第一引数
        //ビューに渡す変数を指定して　profile_formキー (使う時は＄つく)=> $profile変数
        //['profile_image' => $profile_image]  profile_imageは連想配列のキー（blade.phpで表示するために作成）
        //$profile_imageはfunction内で定義したインスタンス。要はblade.phpで表示するキーにしている作業
        //['profile_image' => $profile_image,'a' => 100]と連組配列を追加することも出来る
        return view('auth.profile.userpage',['profile' => $profile]);
        
    }
    
    public function add()
    {
        
        return view('auth.profile.create');
    }
    
    public function create(Request $request)
    {
        $profile_create_rules = array_merge(Profile::$rules, Profile::$messages, Profile::$max_rules, Profile::get_my_rules());
        //validation
        $this->validate($request, $profile_create_rules);

        $profile = new Profile;
        $form = $request->all();
        
        
        //フォームから画像が送信されてきたら、保存して$profile_image->image_pathに画像のパスを保存
        if(isset($form['profile_image'])) {
            //storeで保存先を指定
            $path = $request->file('profile_image')->store('public/profile_image');
            $profile->image_path = basename($path);
        }else{
            $profile->image_path = null;
        }
        
        //Authからuser_idを取り出す
        $profile->user_id = Auth::id();
        
        //フォームから送信されてきたtokenを削除
        unset($form['_token']);
        //フォームから送信されてきた画像を削除
        unset($form['profile_image']);
        //データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        
        return redirect('auth/post');
    }
    
    public function edit(Request $request)
    {
       //Profile Modelから現在ログインしているユーザーのデータを取得
        $profile = Profile::find(Auth::id());
        if (empty($profile)) {
            abort(404);
        }
        
        
        //resourcesのviews以下のファイル：第一引数
        //ビューに渡す変数を指定して　profile_formキー (使う時は＄つく)=> $profile変数
        return view('auth.profile.edit',['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        
        //validationをかける 文字数が10文字以内
        $rule = array_merge(Profile::get_my_rules(), Profile::$max_rules);
        $request->validate($rule);
        

        //↑こっちは下記の記載でもOK
        // $request->validate([
        //         'profile_image' => ['mimes:jpeg,jpg,png', 'max:2000', new ProfileImageRule],
        // ]);
        
        
        //Profile modelからデータを取得
        $profile = Profile::find($request->id);
        //送信されてきたフォームデータを格納
        $profile_form = $request->all();
        
        //元々の$profileのusernameと送信されて来たusernameが一致していなければ
        if($profile->username != $profile_form['username']){
            //$profile_form($request)->username
            $user_name_rules = array_merge(Profile::$rules, Profile::$messages);
            //validationをかける 
            $this->validate($request, $user_name_rules); 
        }
        
        //画像を削除した場合はimage_pathも削除する
        if($request->remove == 'ture'){
            $profile_form['image_path'] = null;

        //画像が更新されたら。。
        }elseif($request->file('profile_image')){
            //上はpublic/profile_imageに画像を保存
            //下はファイル名からpathを作成して(左辺)、image_pathに（右辺に）代入
            $path = $request->file('profile_image')->store('public/profile_image');

            //$profile->image_path = basename($path);
            $profile_form['image_path'] = basename($path);
            
        // }else{
        //     //画像は変わってない時
        //     $profile_form['image_path'] = $profile->image_path;
        }

        unset($profile_form['profile_image']);
        //削除というチェックボックスからチェックを外す（初期化してる）
        unset($profile_form['remove']);
        unset($profile_form['_token']);
        
        //該当するデータを上書き保存
        $profile->fill($profile_form)->save();
        return view ('auth.profile.edit', ['profile_form' => $profile]);
    }
}
