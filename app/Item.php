<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = array('id');

    public function trips()
    {
        return $this->belongsToMany(Trip::class)->using(ItemTrip::class)->withPivot(['memo']);
    }
    
    
    //UserとItem 1対多
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    
    public static $rules = [
        'goods' => ['required', 'max:20'],
        'importance' => ['required']
        ];



}
