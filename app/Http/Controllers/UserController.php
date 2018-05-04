<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin');
    }

    public function change(Request $request) {
        if($request->new != $request->config) {
            return redirect()->route('admin')->with('error', "Error Input New Password");
        } else {
            $user = User::find(1);
            $user->password = bcrypt($request->new);
            $user->save();
        }
        return redirect()->route('home');
    }
}
