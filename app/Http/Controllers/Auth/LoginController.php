<?php

namespace App\Http\Controllers\Auth;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;
use App\Http\Controllers\Controller;
use App\Notifications\UserApprovedNotification;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);

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

        return redirect()->route('home');

    }
    public function update( $request,User $user){
        $request->validate([
            'status' => 'required|string|in:approved,pending,denied',
        ]);

        // Update the user's status
        $user->status = $request->input('status');
        $user->save();

        // Check if the user's status is 'approved'
        if ($user->status == 'approved') {
            // Notify the user about the approval
            $user->notify(new UserApprovedNotification($user));
        }

        return response()->json(['message' => 'User status updated successfully'], 200);
    }

}
