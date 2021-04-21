<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'direction' => 'required',
        'image' => 'required',
        'title' => 'required',
        'body' => 'required',
        );
        
    public static $updateRules = array(
        'direction' => 'required',
        'title' => 'required',
        'body' => 'required',
        );
        
    public static $image_upload_rules = [
        'image' => 'image', 'mimes:jpeg,jpg,png', 'max:2000'
        ];
        

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


