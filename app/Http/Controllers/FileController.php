<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use DateTime;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        return view('file');
    }

    public function fileUpload(Request $request, $project = null) {
        $request->validate([
            'file' => 'required|file',
        ]);

        $fileUpload = $request->file('file');
        $file = new File();
        $path = $request->path;
        $path_add_file = $request->path;
        if($path_add_file != null) {
            do {
                $element = File::where('name', $path)->get()->toArray();
                $find_parent = File::where('id', $element[0]['parent'])->get()->toArray();
                if($find_parent == null) {
                    break;
                }
                $path = $find_parent[0]['name'];
                $path_add_file = $path."/".$path_add_file;
            }while($find_parent != null);
        }
        $file->name = $fileUpload->getClientOriginalName();
        $file->extension = $fileUpload->getClientOriginalExtension();
        $uploaded_path = Storage::disk('spaces')->putFile($path_add_file, $request->file, 'public');
        $url = Storage::disk('spaces')->url($uploaded_path); 
        $file->path = $uploaded_path;
        $file->url = $url;
        if($request->path == null)
            $file->parent = null;
        else {
            $element = File::where('name', $request->path)->get()->toArray();
            $file->parent = $element[0]['id'];
        }
        $file->save();
        
        return redirect()->route('home');
    }

    public function addProject(Request $request, $project = null) {
        $file = new File();
        $file->name = $request->project;
        $file->url = route('home')."/".$request->project;
        $file->extension = "folder";
        if($request->path == null)
            $file->parent = null;
        else {
            $element = File::where('name', $request->path)->get()->toArray();
            $file->parent = $element[0]['id'];
        }
        $file->save();

        return redirect()->route('home');
    }

    public function edit(Request $request, $id) {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = File::find($id);
        Storage::disk('spaces')->delete($file->path);
        $request->validate([
            'file' => 'required|file',
        ]);
        $file->id = $id;
        $fileUpload = $request->file('file');
        $path = $request->path;
        $path_add_file = $request->path;
        if($path_add_file != null) {
            do {
                $element = File::where('name', $path)->get()->toArray();
                $find_parent = File::where('id', $element[0]['parent'])->get()->toArray();
                if($find_parent == null) {
                    break;
                }
                $path = $find_parent[0]['name'];
                $path_add_file = $path."/".$path_add_file;
            }while($find_parent != null);
        }
        $file->name = $fileUpload->getClientOriginalName();
        $file->extension = $fileUpload->getClientOriginalExtension();
        $uploaded_path = Storage::disk('spaces')->putFile($path_add_file, $request->file, 'public');
        $url = Storage::disk('spaces')->url($uploaded_path); 
        $file->path = $uploaded_path;
        $file->url = $url;
        if($request->path == null)
            $file->parent = null;
        else {
            $element = File::where('name', $request->path)->get()->toArray();
            $file->parent = $element[0]['id'];
        }
        $file->save();
        return redirect()->route('home');
    }

    public function editProject(Request $request, $id) {
        $project = File::find($id);
        $project->name = $request->project;
        $project->url = route('home')."/".$request->project;
        $project->save();
        return redirect()->route('home');
    }

    public function delete($id) {
        $file = File::find($id);
        Storage::disk('spaces')->delete($file->path);
        $file->delete();
        return redirect()->route('home');
    }

    public function deleteProject($id) {
        $files = File::where('parent', $id)->get()->toArray();
        $this->deleteFolder($files);
        File::find($id)->delete();
        return redirect()->route('home');
    }

    public function deleteFolder($files) {
        foreach($files as $file) {
            if($file['extension'] != "folder") {
                Storage::disk('spaces')->delete($file['path']);
                File::find($file['id'])->delete();
            } else {
                $f = File::where('parent', $file['id'])->get()->toArray();
                if($f != null)
                    $this->deleteFolder($f);
                File::find($file['id'])->delete();
            }
        }
    }
}
