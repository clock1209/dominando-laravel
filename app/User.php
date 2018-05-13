<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function note()
    {
        return $this->morphOne('App\Note', 'parent');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'parent', 'taggables')->withTimestamps();
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = bcrypt($password);
    }

    public function implodeTags()
    {
        return $this->tags->pluck('name')->implode(', ');
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param array $roles
     * @return mixed
     */
    public function hasRole(array $roles)
    {
        return $this->roles->pluck('name')->intersect($roles)->count();
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole(['admin']);
    }
}
