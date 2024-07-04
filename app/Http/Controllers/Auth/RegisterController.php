<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AdminNewUserNotification;

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
            'password' => 'required|confirmed',
            'image' => 'required|image|max:2048',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return back()->with('status', 'Korisnik sa unetim emailom već postoji');
        }

        $users = User::all();
        foreach ($users as $user) {
            if (Hash::check($request->password, $user->password)) {
                return back()->with('status', 'Korisnik sa unetim passwordom već postoji');
            }
        }

        $username = $this->generateUsername($request->name);

        $user = new User();
        $user->name = $request->name;
        $user->surrname = $request->surrname;
        $user->username = $username;
        $user->email = $request->email;
        $user->state = $request->state;
        $user->place = $request->place;
        $user->date = $request->date;
        $user->jmbg = $request->jmbg;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        $user->save();

        $administrators = User::where('usertype', 'admin')->get();
        foreach ($administrators as $administrator){
            $administrator->notify(new AdminNewUserNotification($user));
        }

        return redirect()->route('register.index')->with('message', 'Čekajte za odobrenje!');
    }

    private function generateUsername($name){
        return strtolower($name) . rand(100, 999);
    }
}
