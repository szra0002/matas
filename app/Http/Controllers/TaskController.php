<?php

namespace App\Http\Controllers;

use App\Task;
use App\File;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Show the page to create a task.
     *
     * @var File $file
     * @return \Illuminate\Http\Response
     */
    public function create(File $file){

        if($this->checkUser($file)){
            return view('createTask', compact('file'));
        }
        else{
            return redirect('/')->with('message', 'You cannot create a task for a list that does not belong to you!');
        }

    }

    /**
     * create a new task.
     *
     * @var Request $request
     * @var File $file 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, File $file){
        $this->validate($request,
            ['contents' => 'required|max:255',
            ]);

        if($this->checkUser($file)) {
            $task = new Task;
            $task->content = $request->contents;
            $file->tasks()->save($task);
            return redirect('/file/' . $file->id);
        }else{
            return redirect('/file/' . $file->id)->with('message', 'You cannot create a task for a list that does not belong to you!');
        }
    }
    
    /**
     * Show the page to edit an existing task.
     *
     * @var Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task){
        $file = $task->file;
        if($this->checkUser($file)) {
            return view('createTask', compact('task'));
        }else{
            return redirect('/')->with('message', 'You cannot edit a task for a list that does not belong to you!');
        }
    }

    /**
     * update an existing task.
     *
     * @var Request $request
     * @var Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task){
        $this->validate($request,
            ['contents' => 'required|max:255,|unique:tasks,content,' .$task->id,
            ]);

        $file = $task->file;
        if($this->checkUser($file)) {
            $task->content = $request->contents;
            $task->save();
            $file = $task->file;
            return redirect('/file/' . $file->id);
        }else{
            return redirect('/file/' . $file->id)->with('message', 'You cannot update a task for a list that does not belong to you!');
        }

    }

    /**
     * soft-delete an existing task.
     *
     * @var Task $task
     * @return \Illuminate\Http\Response
     */
    public function delete(Task $task){
        $file = $task->file;

        if($this->checkUser($file)) {
            $task->delete();
            return redirect('/file/' . $file->id);
        }else {
            return redirect('/')->with('message', 'You cannot delete a task for a list that does not belong to you!');
        }
    }

    /**
     * check if the authenticated user is the same as the user of the file.
     *
     * @var File $file
     * @return boolean
     */
    private function checkUser(File $file){
        $user = Auth::user();

        if($file->user->id == $user->id) {
            return true;
        }else{
            return false;
        }
    }
}
