<?php

namespace App\Presenters;

use Illuminate\Support\HtmlString;

class MessagePresenter extends Presenter
{
    public function userName()
    {
        if ($this->model->user_id) {
            return $this->userLink();
        }
        return $this->model->nombre;
    }

    public function userEmail()
    {
        if ($this->model->user_id) {
            return $this->model->user->email;
        }
        return $this->model->email;
    }

    public function link()
    {
        return new HtmlString('<a href="'. route('messages.show', $this->model->id) .'">'. str_limit($this->model->mensaje, 30, ' ...') .'</a>');
    }

    public function userLink()
    {
        return $this->model->user->present()->link();
    }

    public function notes()
    {
        return $this->model->note ? $this->model->note->body : new HtmlString('<span class="badge badge-secondary">no tiene</span>');
    }

    public function tags()
    {
        return $this->model->tags->isEmpty() ? $this->model->implodeTags() : new HtmlString('<span class="badge badge-secondary">no tiene</span>');
    }
}