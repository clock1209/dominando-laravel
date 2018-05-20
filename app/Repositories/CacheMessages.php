<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CacheMessages implements MessagesInterface
{
    protected $messages;

    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @return mixed
     */
    public function getPaginated()
    {
        $key = 'messages.page.' . request('page', 1);
        return Cache::tags('messages')->rememberForever($key, function () {
            return $this->messages->getPaginated();
        });
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $message = $this->store($request);

        Cache::tags('messages')->flush();
        return $message;
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Cache::tags('messages')->rememberForever("messages.{$id}", function () use ($id){
            return $this->messages->findById($id);
        });
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param $request
     * @param $message
     * @return mixed
     */
    public function update($request, $message)
    {
        $message = $this->messages->update($request, $message);
        Cache::tags('messages')->flush();
        return $message;
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param $message
     * @return mixed
     */
    public function destroy($message)
    {
        $message = $this->messages->destroy($message);
        Cache::tags('messages')->flush();
        return $message;
    }
}