<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit ()
    {
        $user = \Auth::user();
        return view('profile', compact('user'));
    }

    public function update (Request $request)
    {
        $user = \Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect(route('profile.edit'));
    }
}
