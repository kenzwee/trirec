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
        return $this->belongsToMany(Item::class)->using(ItemTrip::class)->withPivot(['memo']);
    }
    
}
