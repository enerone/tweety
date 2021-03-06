<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use  App\Models\User;


class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show',compact('user'));

    }

    public function edit(User $user)
    {


        return view('profiles.edit',compact('user'));

    }

    public function update(User $user)
    {


        $attributes = request()->validate([
                'username'=>[
                    'string',
                    'required',
                    'max:255',
                    'alpha_dash',
                    Rule::unique('users')->ignore($user),
                ],
                'name' => [
                    'string',
                    'required',
                    'max:255'
                ],
                'avatar' =>[
                    'required',
                    'file'
                ],
                'email' =>  [
                    'string',
                    'required',
                    'max:255',
                    Rule::unique('users')->ignore($user),
                ],
                'password' =>  [
                    'string',
                    'required',
                    'min:8',
                    'max:255',
                    'confirmed'
                ]
            ]);

        $atributes['avatar'] = request('avatar')->store('avatars');


        Storage::putFileAs(
            'avatars', request('avatar'), $user->id
        );


        $user->update($attributes);

        return redirect($user->path());
    }
}
