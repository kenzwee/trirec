<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rules\AddImageRule;

class Profile extends Model
{
    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static $rules = [
        'username' => ['required','unique:profiles']
        ];
        
    public static $max_rules = [
        'username' => ['max:10'],
        'introduction' => ['max:200'],
        'want_to_travel_world' => ['max:200'],
        'traveled_world' => ['max:200'],
        'want_to_travel_japan' => ['max:200'],
        'traveled_japan' => ['max:200']
        ];
    
    public static $messages = [
        'username.unique' => 'このユーザー名はすでに使用されています'
        ];
    
    // public static $profile_image_upload_rules = [
    //     'profile_image' => 'image', 'mimes:jpeg,jpg,png', 'max:2000', new HeicRule,
    //     ];

    public static function get_my_rules()
    {
        return [    
        'profile_image' => [new AddImageRule, 'mimes:jpeg,jpg,png', 'max:2000'],
        ];
    }
    

        
            
    

        
}
