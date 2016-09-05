<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class FileController extends Controller
{
    /**
     * Show all the files that was given.
     *
     * @var File $file
     * @return \Illuminate\Http\Response
     */
    public function index(File $file){
        $tasks = $file->tasks;
        return view('file', compact('file', 'tasks'));
    }

    /**
     * Show the page to create a file.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $user = Auth::user();
        if ($user->name != 'Guido Bergman')
        return redirect('/');

        $users = User::all();

        return view('createFile', compact('users'));
    }

    /**
     * create a new file.
     *
     * @var Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request,
            ['name' => 'required|unique:files|max:50',
            'user_id' => 'required',
            ]);

        $file = new File;
        $user = User::find($request->user_id);

        $file->name = $request->name;
        $user->files()->save($file);
        return redirect('/');

    }

    /**
     * Show the page to edit an existing file.
     *
     * @var File $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file){
        $user = Auth::user();
        if ($user->name != 'Guido Bergman')
            return redirect('/');

        $users = User::all();
        return view('createFile', compact('file', 'users'));
    }

    /**
     * update an existing file.
     *
     * @var Request $request
     * @var File $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file){
        $this->validate($request,
            ['name' => 'required|max:50|unique:files,name,'.$file->id,
            'user_id' => 'required' ,
            ]);

        $file->name = $request->name;
        $file->user_id = $request->user_id;
        $file->update();
        return redirect('/');
    }

    /**
     * soft-delete an existing file.
     *
     * @var File $file
     * @return \Illuminate\Http\Response
     */
    public function delete(File $file){
        $user = Auth::user();
        if ($user->name != 'Guido Bergman')
            return redirect('/')->with('message', 'You are not allowed to do that');

        if($file->tasks->first()){
            return redirect('/')->with('message', 'All tasks must be completed before you can delete this list');
        }else {
            $file->delete();
            return redirect('/');
        }
    }
}
