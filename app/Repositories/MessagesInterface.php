<?php

namespace App\Repositories;


interface MessagesInterface
{
    public function getPaginated();
    public function store($request);
    public function findById($id);
    public function update($request, $message);
    public function destroy($message);
}