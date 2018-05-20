<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessageReceived;
use App\Repositories\MessagesInterface;
use App\Http\Requests\CreateMessageRequest;

class MessageController extends Controller
{
    protected $messages;

    /**
     * MessageController constructor.
     * @param MessagesInterface $messages
     */
    public function __construct(MessagesInterface $messages)
    {
        $this->messages = $messages;
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->messages->getPaginated();
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param CreateMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateMessageRequest $request)
    {
        $message = $this->messages->store($request);
        event(new MessageReceived($message));

        return redirect()->route('messages.create')->with('info', 'Recibimos tu mensjae.');
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param Integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $message = $this->messages->findById($id);
        return view('messages.show', compact('message'));
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param Integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $message = $this->messages->findById($id);
        return view('messages.edit', compact('message'));
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param CreateMessageRequest $request
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateMessageRequest $request, Message $message)
    {
        $message = $this->messages->update($request, $message);

        return redirect()->route('messages.index');
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Message $message)
    {
        $this->messages->destroy($message);

        return redirect()->route('messages.index');
    }
}
