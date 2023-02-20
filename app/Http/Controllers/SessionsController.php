<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    //
    public function destroy()
    {
        auth()->logout();

        return redirect('/products')->with('success', 'You have been logged out');
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($attributes))
        {
            session()->regenerate();
            return redirect('/products')->with('success', 'Welcome Back');
                # code...
        }

        throw ValidationException::withMessages([
           'email' => 'Your provided credentials could not be verified'
        ]);
    }
        
}