<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable=[
      'rad1', 'rad2', 'rad3'
    ];

    public function getRatingAttribute()
    {
        return (($this->rad1+$this->rad2+$this->rad3)/3);
    }
}
