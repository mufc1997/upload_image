<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($project = null)
    {   
        if(!$project) {
            $files = File::whereNull('parent_id')->get();
            return view('home', compact("files"));  
        } else {
            if($project == 'admin') {
                return view('admin');
            }
            $files = File::whereNull('parent_id')->get();
            $find = File::where('name', $project)->get()->toArray();
            if(!$find) {
                return redirect()->route('home');  
            }
            $files = File::where('parent_id', $find[0]['id'])->get();
            if(!$files) {
                return redirect()->route('home');
            }
            return view('home', compact("files"));
        }
    }
}
