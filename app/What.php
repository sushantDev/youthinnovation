<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class what extends Model
{
    protected $fillable=[
	  'facts',
      'data',
      'spirit',
      'strategy',
      'advocacy'
    ];
         public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function delete(array $options = array())
    {
        if ($this->image)
        {
            $this->image->delete();
        }

        return parent::delete($options);
    }
}
