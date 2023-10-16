@extends('layouts.app')

@section('page-title', 'Exercises dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>All exercises</h1>
                @foreach($exercises as $exercise)
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Title:</strong> {{$exercise->title}} | <strong>By:</strong> {{$exercise->user->name}} | <strong>At:</strong> {{$exercise->created_at}}</li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
@endsection
