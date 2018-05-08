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
            $path = "Home/";
            $files = File::whereNull('parent_id')->get();
            return view('home', compact("files", "path"));  
        } else {
            if($project == 'admin') {
                return view('admin');
            }
            $path = $project;
            $path_add_file = $project;
            if($path_add_file != null) {
                do {
                    $element = File::where('name', $path)->get()->toArray();
                    $find_parent_id = File::where('id', $element[0]['parent_id'])->get()->toArray();
                    if($find_parent_id == null) {
                        break;
                    }
                    $path = $find_parent_id[0]['name'];
                    $path_add_file = $path."/".$path_add_file;
                }while($find_parent_id != null);
            }
            $path = "Home/".$path_add_file;
            $files = File::whereNull('parent_id')->get();
            $find = File::where('name', $project)->get()->toArray();
            if(!$find) {
                return redirect()->route('home');  
            }
            $files = File::where('parent_id', $find[0]['id'])->get();
            if(!$files) {
                return redirect()->route('home');
            }
            return view('home', compact("files", "path"));
        }
    }
}
