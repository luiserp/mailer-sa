<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = $request->get('order', 'id');

        $users = User::all()->toQuery()->orderBy($order)
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->OrWhere('email', 'like', '%' . $search . '%')
                    ->OrWhere('cedula', 'like', '%' . $search . '%')
                    ->OrWhere('phone_number', 'like', '%' . $search . '%');
            })->paginate(5);

        foreach ($users as $user) {
            $user->load('city');
        }
        return Inertia::render(
            'Users/Index',
            [
                'users' => $users
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Users/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        User::create($validated);
        return redirect()->route('users.index')->with('message', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('city');
        return Inertia::render(
            'Users/Edit',
            [
                'user' => $user
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('city');
        $user->city->load('state');
        $user->city->state->load('country');
        return Inertia::render(
            'Users/Edit',
            [
                'user' => $user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->safe()->except(['cedula', 'email']);
        $user->fill($validated);
        $user->save();

        return redirect()->route('users.index')->with('message', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('message', 'User Delete Successfully');
    }
}
