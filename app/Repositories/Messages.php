<?php

namespace App\Repositories;

use App\Message;

class Messages implements MessagesInterface
{
    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginated()
    {
        return Message::with(['user', 'note', 'tags'])
            ->orderBy('created_at', request('sorted', 'desc'))
            ->paginate(15);
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $message = Message::create($request->all());

        if (auth()->check()) {
            auth()->user()->messages()->save($message);
        }

        return $message;
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Message::findOrFail($id);
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param $request
     * @param $message
     * @return mixed
     */
    public function update($request, $message)
    {
        return $message->update($request->all());
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param $message
     * @return mixed
     */
    public function destroy($message)
    {
        return $message->delete();
    }
}