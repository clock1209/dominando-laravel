<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        $this->middleware('user.role:admin', ['except' => ['edit', 'update', 'show']]);
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = Cache::tags('users')->rememberForever('with:roles-note-tags', function() {
            return User::with(['roles', 'note', 'tags'])->get();
        });
        return view('users.index', compact('users'));
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Cache::tags('roles')->rememberForever('pluck', function() {
            return Role::pluck('display_name', 'id');
        });
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->attach($request->roles);
        Cache::tags('users')->flush();
        return redirect()->route('users.index');
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param Integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = Cache::tags('users')->rememberForever($id, function() use($id) {
            return User::with('roles')->findOrFail($id);
        });

        return view('users.show', compact('user'));
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param Integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $user = Cache::tags('users')->rememberForever($id, function() use($id) {
            return User::with('roles')->findOrFail($id);
        });

        $this->authorize('edit', $user);

        $roles = Cache::tags('roles')->rememberForever('pluck', function() {
            return Role::pluck('display_name', 'id');
        });

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->except(['password']));
        $user->roles()->sync($request->roles);
        Cache::tags("users")->flush();
        return back()->with('info', 'Los datos se actualizaron satisfactoriamente.');
    }

    /**
     * @author Octavio Cornejo <octavio.cornejo@nuvemtecnologia.mx>
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        Cache::tags("users")->flush();
        return redirect()->route('users.index');
    }
}
