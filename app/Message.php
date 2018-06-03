<?php

namespace App;

use App\Presenters\MessagePresenter;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'phone',
        'mensaje',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function note()
    {
        return $this->morphOne('App\Note', 'parent');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'parent', 'taggables')->withTimestamps();
    }

    public function implodeTags()
    {
        return $this->tags->pluck('name')->implode(', ');
    }

    public function scopeTest($query)
    {
        return $query->has('user');
    }

    public function present()
    {
        return new MessagePresenter($this);
    }
}
