<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
     public function items()
    {
        return $this->belongsToMany('App\Item');
    }
    
    public static $create_rules = [
        'title' => ['required', 'max:20'],
        'trip_start' => ['required','after_or_equal:yesterday'],
        'trip_end' => ['required','after_or_equal:trip_start']
        ];
        

}
