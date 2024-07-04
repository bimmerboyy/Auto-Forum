<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{ public function index()
    {
        $users = Auth::user()->usertype == 'admin' ? User::all() : [];
        return view('profile.index', compact('users'));
    }

    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        /** @var \App\Models\User $user */
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Password changed successfully.');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:approved,denied'
        ]);

        $user = User::find($request->user_id);
        $user->status = $request->input('status');
        $user->save();

        return redirect()->route('profile.index')->with('success', 'User status updated successfully.');
    }

    public function changeUsertype(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'usertype' => 'required|in:user,moderator'
        ]);

        $user = User::find($request->user_id);
        $user->usertype = $request->usertype;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'User usertype updated successfully.');
    }

    public function deleteUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $user->delete();

        return redirect()->route('profile.index')->with('success', 'User deleted successfully.');
    }
}
