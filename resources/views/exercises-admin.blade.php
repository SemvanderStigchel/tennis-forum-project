@extends('layouts.app')

@section('page-title', 'Exercises dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>All exercises</h1>
                @foreach($exercises as $exercise)
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Title:</strong> {{$exercise->title}} |
                            <strong>By:</strong> {{$exercise->user->name}} |
                            <strong>At:</strong> {{$exercise->created_at}}
                            <form id="form" action="{{route('exercises.delete', $exercise)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-check form-switch">
                                    <input class="form-check-input checkbox" type="checkbox" role="switch"
                                           id="flexSwitchCheckDefault" name="on" @if(!$exercise->trashed()) checked @endif value="1">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Exercise Off/On</label>
                                </div>
                            </form>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
@endsection
