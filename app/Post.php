<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rules\AddImageRule;


class Post extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'direction' => 'required',
        'image' => 'required',
        'title' => 'required|max:20',
        'body' => 'required',
        );
        
    public static $updateRules = array(
        'direction' => 'required',
        'title' => 'required',
        'body' => 'required|max:150',
        );
        

    public static function get_my_rules()
    {
        return [    
        'image' => [new AddImageRule, 'mimes:jpeg,jpg,png', 'max:2000'],
        ];
    }
        

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany('App\History');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    

}


