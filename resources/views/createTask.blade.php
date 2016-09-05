@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(isset($task))
        <form method="post" action="/task/{{$task->id}}/update">
            <input type="hidden" name="_method" value="patch">
        @else
        <form method="post" action="/file/{{$file->id}}/task/store">
            <input type="hidden" name="_method" value="post">
        @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="sel1">Content task:</label>
                <input type="text" name="contents" class="form-control" @if(isset($task) && $task->content) value="{{$task->content}}" @endif>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
        </form>
    </div>
@endsection