<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemTrip extends Pivot
{
    protected $table = "item_trip";
    
    public static $memo_rules = [
        'memo' => ['required', 'max:20'],
        ];
}
