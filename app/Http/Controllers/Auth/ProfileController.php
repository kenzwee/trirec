<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Post;
use App\User;
use App\Rules\AddImageRule;
use Storage;


class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.profile.index');
    }
    
    public function show(Request $request)
    {
        $profile = Profile::where('user_id', $request->id)->first();
        $posts = Post::where('user_id', $request->id)->orderBy('created_at', 'desc')->take(6)->get();

        return view('auth.profile.userpage',['profile' => $profile, 'posts' => $posts]);
        
    }
    
    public function add()
    {
        
        return view('auth.profile.create');
    }
    
    public function create(Request $request)
    {
        $profile_create_rules = array_merge(Profile::$rules, Profile::$messages, Profile::$max_rules, Profile::get_my_rules());
        $this->validate($request, $profile_create_rules);

        $profile = new Profile;
        $form = $request->all();
        
        if(isset($form['profile_image'])) {
            $path = Storage::disk('s3')->putFile('/', $form['profile_image'], 'public');
            $profile->image_path = Storage::disk('s3')->url($path);
        }else{
            $profile->image_path = null;
        }
        
        
        // if(isset($form['profile_image'])) {
        //     $path = $request->file('profile_image')->store('public/profile_image');
        //     $profile->image_path = basename($path);
        // }else{
        //     $profile->image_path = null;
        // }
        
        $profile->user_id = Auth::id();
        
        unset($form['_token']);
        unset($form['profile_image']);
        $profile->fill($form);
        $profile->save();
        
        
        return redirect('auth/post');
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::where('user_id', $request->id)->first();
        if (empty($profile)) {
            abort(404);
        }
        
        return view('auth.profile.edit',['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        $rule = array_merge(Profile::get_my_rules(), Profile::$max_rules);
        $request->validate($rule);

        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        
        if($profile->username != $profile_form['username']){
            $user_name_rules = array_merge(Profile::$rules, Profile::$messages);
            $this->validate($request, $user_name_rules); 
        }
        
        if($request->remove == 'ture'){
            $profile_form['image_path'] = null;

        }elseif($request->file('profile_image')){
            // $path = $request->file('profile_image')->store('public/profile_image');
            // $profile_form['image_path'] = basename($path);
            $path = Storage::disk('s3')->putFile('/',$profile_form['profile_image'],'public');
            $profile_form->image_path = Storage::disk('s3')->url($path);
        }
        

        unset($profile_form['profile_image']);
        unset($profile_form['remove']);
        unset($profile_form['_token']);
        
        $profile->fill($profile_form)->save();
        $user_id = $profile->user_id;
        return redirect (route('userpage', ['id' => $user_id]));

    }
}
