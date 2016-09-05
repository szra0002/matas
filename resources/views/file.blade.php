@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">List {{$file->name}}</div>
                    <div class="panel-body">
                        <form method="get" action="/file/{{$file->id}}/task">
                            <button type="submit" class="btn btn-primary">
                                Add Task
                            </button>
                        </form>
                        <hr>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>content</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task->id}}</td>
                                    <td>{{$task->content}}</td>
                                    <td>
                                        <form method="get" action="/task/{{$task->id}}/edit">
                                            <input type="hidden" name="_method" value="get">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="/task/{{$task->id}}/delete">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection