<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create(){
        return view('registration.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|string|max:50',
            'password' => 'required|string|max:20',
            'name' => 'required|string|max:20',
            'birth' => 'required|string|max:20',
            'addr' => 'required|string|max:20',
        ]);
        $user = \App\User::create([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'name' => $request->input('name'),
            'birth' => $request->input('birth1'),
            'addr' => $request->input('addr1'),
        ]);
        auth()->login($user);
        flash(auth()->user()->name.'님 환영합니다');
        return redirect('bbs');
    }
}
