<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function taggable()
    {
        return $this->morphByMany('App\Message', 'parent');
    }
}