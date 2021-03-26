<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static $rules = [
        'username' => ['required','unique:profiles,username']
        ];
        
    public static $max_rules = [
        'username' => ['max:10']
        ];
    
    public static $messages = [
        'username.unique' => 'このユーザー名はすでに使用されています'
        ];
 

    // public static $updateRules = [
    //     'username' => ['required','unique:profiles,username','max:10']
    //     ];
        
}
