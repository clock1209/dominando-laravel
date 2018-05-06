<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * MessageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();
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
        Message::create($request->all());
        return redirect()->route('messages.create')->with('info', 'Recibimos tu mensjae.');
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param Message $message
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param Message $message
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Message $message)
    {
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
        $message->update($request->all());
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
        $message->delete();
        return redirect()->route('messages.index');
    }
}
