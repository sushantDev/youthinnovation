<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUser;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('backend.user.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // dd('1');
    
        return view('backend.user.create');
    }

    /**
     * @param StoreUser $request
     * @return mixed
     */
    public function store(StoreUser $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $user = User::create($data);

            $this->uploadRequestImage($request, $user);

        });
        return redirect()->route('user.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'User' ]));
    }

    public function show(User $user)
    {
      return view('backend.user.show', compact('user'));
    }

    public function edit(User $user)
    {

        return view('backend.user.edit', compact('user'));   
    }

    public function update(UpdateUser $request, User $user)
    {
        DB::transaction(function () use ($request, $user)
        {
            $data = $request->data();

            $user->update($data);

            if (array_key_exists('role', $data))
            {
                $user->roles()->sync([$data['role']]);
            }

            $this->uploadRequestImage($request, $user);

        });
        return redirect()->route('user.index')->with('success', trans('messages.update_success', ['entity' => 'User']));
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'User' ]));
    }
}