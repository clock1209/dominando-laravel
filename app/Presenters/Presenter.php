<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 01/06/2018
 * Time: 09:58 PM
 */

namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

class Presenter
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}