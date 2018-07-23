<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'author',
        'quote',
        'body'
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Set the title attribute and the slug.
     *
     * @param string $value
     */
    /**
     * @param $query
     * @param bool $type
     * @return mixed
     */
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
    public function delete(array $options = array())
    {
        if ($this->image)
        {
            $this->image->delete();
        }

        return parent::delete($options);
    }
}