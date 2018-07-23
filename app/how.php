<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class how extends Model
{
    protected $fillable=[
      'body'
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
