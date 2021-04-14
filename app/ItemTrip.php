<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemTrip extends Pivot
{
    protected $table = "item_trip";

    // public function trips()
    //     {
    //         return $this->belongsTo(Trip::class);
    //     }
        
    // public function items()
    //     {
    //         return $this->belongsTo(Item::class);
    //     }
}
