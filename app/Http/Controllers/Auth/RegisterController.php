<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index(){
        return view('auth.register');
    }
    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'jmbg' => 'required|unique:users',
            'password' => 'required|confirmed,unique:users',
            'surrname' => 'nullable',
        ]);
        if (User::where('email', $request->email)->exists()) {
            return back()->with('status', 'Korisnik sa unetim emailom već postoji');
        }

        $username = $this->generateUsername($request->name);
        User::create([
            'name' => $request->name,
            'surrname' => $request->surrname,
            'username' => $username,
            'email' => $request->email,
            'state' => $request->state,
            'place' => $request->place,
            'date' => $request->date,
            'jmbg' => $request->jmbg,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'gender' => $request->gender
        ]);
        $existingUser = User::where('email', auth()->user()->email)->first();
        if ($existingUser) {
            return redirect('register')->withErrors(['email' => 'Korisnik sa ovom email adresom već postoji.']);
        }
        auth()->attempt($request->only('email','password'));
        return redirect()->route('dashboard');
    }
    private function generateUsername($name){
    return strtolower($name) . rand(100, 999);
    }
}
