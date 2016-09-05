@extends('layouts.app')

@section('content')
@if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if($user->name == "Guido Bergman")
                        <form method="get" action="/file">
                            <button type="submit" class="btn btn-primary">
                                Add List
                            </button>
                        </form>
                        <hr>
                    @endif
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            @if($user->name == "Guido Bergman")
                                <th>Assigned to</th>
                                <th>Edit</th>
                            @endif
                            <th>Delete</th>
                            <th>Open</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>{{$file->id}}</td>
                                    <td>{{$file->name}}</td>
                                    @if($user->name == "Guido Bergman")
                                        <td>{{$file->user['name']}}</td>
                                        <td>
                                            <form method="get" action="/file/{{$file->id}}/edit">
                                                <input type="hidden" name="_method" value="get">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                    <td>
                                        <form method="post" action="/file/{{$file->id}}/delete">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Delete
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="get" action="/file/{{$file->id}}">
                                            <input type="hidden" name="_method" value="get">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Open
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
