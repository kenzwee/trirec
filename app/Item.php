<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static $create_rules = [
        'trip_title' => ['required', 'max:20'],
        'trip_start' => ['required','after_or_equal'],
        'trip_end' => ['required','before_or_equal']
        ];
        

}
