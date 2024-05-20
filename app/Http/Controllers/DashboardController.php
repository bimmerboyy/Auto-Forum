<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index(){
        if(Auth::id()){
            $usertype = auth()->user()->usertype;
            if($usertype === 'user'){
              return view('dashboard');
            }
            else if($usertype == 'admin'){
              return view('admin.adminhome');
            }
            else if($usertype == 'moderator'){
                return view('moderator.moderatorhome');
              }
            else{
                return redirect()->back();
            }
        }
    }
}
