<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;
use Closure;


class LoginController extends Controller
{
    public function __construct()
    {   $this->middleware(['guest']);

    }
    public function index(){

        return view('auth.login');
    }
    public function store(Request $request){


        $this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required',
        ],
        [
            'email.required' => 'Unesite email',
            'password.required' => 'Unesite šifru',
        ]);

       if(!auth()->attempt($request->only('email','password'))) {
            return back()->with('status','Nevalidan unos podataka');
       }

        return redirect()->route('dashboard');

    }

}
