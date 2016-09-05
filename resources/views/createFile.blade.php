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
        @if(isset($file))
        <form method="post" action="/file/{{$file->id}}/update">
            <input type="hidden" name="_method" value="patch">
        @else
        <form method="post" action="/file/store">
            <input type="hidden" name="_method" value="post">
        @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="sel1">Name list:</label>
                <input type="text" name="name" class="form-control"@if(isset($file) && $file->name) value="{{$file->name}}" @endif>
            </div>
            <div class="form-group">
                <label for="sel1">Assign to:</label>
                <select class="form-control" name="user_id" id="user_id">
                @if(isset($file) && $file->user_id) value="{{$file->user_id}}" @endif>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add file</button>
            </div>
        </form>
    </div>
@endsection