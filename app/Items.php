<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Items extends Model
{
    //
    protected $table = 'item';

    public function scopeGetItems($query)
    {
        return $query->where('owner_id', Auth::user()->user_id)->paginate(10, ['*'], 'itemPage');
    }

    public function scopeSearchByName($query, $input)
    {
        return $query->where('name', 'LIKE', "%{$input}%");
    }
}
