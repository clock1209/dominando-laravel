<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 01/06/2018
 * Time: 10:03 PM
 */

namespace App\Presenters;


use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter
{
    public function link()
    {
        return new HtmlString('<a href="'. route('users.show', $this->model->id) .'">'. $this->model->name .'</a>');
    }

    public function roles()
    {
        return $this->model->roles->pluck('display_name')->implode(', ') ?: '<span class="badge badge-secondary">no tiene</span>';
    }

    public function notes()
    {
        return $this->model->note ? $this->model->note->body : new HtmlString('<span class="badge badge-secondary">no tiene</span>');
    }

    public function tags()
    {
        return !$this->model->tags->isEmpty() ? $this->model->implodeTags() : new HtmlString('<span class="badge badge-secondary">no tiene</span>');
    }
}