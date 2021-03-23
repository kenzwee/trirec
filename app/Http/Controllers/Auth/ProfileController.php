<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;


class ProfileController extends Controller
{
    public function add()
    {
        return view('auth.profile.create');
    }
    
    public function create(Request $request)
    {
        
        //validation
        $this->validate($request, Profile::$rules, Profile::$messages);
        

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
       //Profile Modelからデータを取得 $request->idでデータ取得
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        //resourcesのviews以下のファイル：第一引数
        //ビューに渡す変数を指定して　profile_formキー (使う時は＄つく)=> $profile変数
        return view('auth.profile.edit',['profile_form' => $profile]);
    }
    
    public function update()
    {
        //validationをかける ::→クラス変数を呼び出し
        $this->validate($request, Profile::$updateRules, Profile::$messages);
        //Profile modelからデータを取得
        $profile = Profile::find($request->id);
        //送信されてきたフォームデータを格納
        $profile_form = $request->all();
        
        //画像を削除した場合はimage_pathも削除する
        if($request->remove == 'ture'){
            $profile_form['image_path'] = null;
        //画像が更新されたら。。
        }elseif($request->file('profile_image')){
            //上はpublic/profile_imageに画像を保存
            //下はファイル名からpathを作成して(左辺)、image_pathに（右辺に）代入
            $path = $request->file('profile_image')->store('public/profile_image');
            $profile_form['image_path'] = basename($path);
        }else{
            //画像は変わってない時
            $profile_form['image_path'] = $profile->image_path;
        }
        
        unset($profile_form['image']);
        //削除というチェックボックスからチェックを外す（初期化してる）
        unset($profile_form['remove']);
        unset($profile_form['_token']);
        
        //該当するデータを上書き保存
        $profile->fill($profile_form)->save();
        return view('auth/profile/edit');
    }
}
