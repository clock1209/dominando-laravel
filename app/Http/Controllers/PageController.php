<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function saludos($nombre = 'Invitado')
    {
        return view('saludos', compact('nombre'));
    }
}
