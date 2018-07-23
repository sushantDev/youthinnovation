<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainProject extends Model
{
    protected $fillable=[
        'author',
        'moto',
        'title',
        'about_title',
        'title_description',
        'problem_context',
        'problem_description',
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @param array $options
     * @return bool|null|void
     * @throws \Exception
     */
    public function delete(array $options = [])
    {
        if ($this->image)
        {
            $this->image->delete();
        }

        return parent::delete($options);
    }
}
