<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = array('id');

    public function trips()
    {
        return $this->belongsToMany('App\Trip');
    }
    

    public static $rules = [
        'body' => ['required', 'max:20'],
        'importance' => ['required']
        ];
    

}
