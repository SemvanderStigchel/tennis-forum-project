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
                                <div class="form-check form-switch">
                                    <label class="form-label">Exercise status:@if(!$exercise->trashed()) <strong>On</strong> @else <strong>Off</strong> @endif</label>
                                    <button class="form-control btn @if(!$exercise->trashed()) btn-danger @else btn-primary @endif" type="submit"
                                            name="on">Switch @if(!$exercise->trashed()) off @else on @endif</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
@endsection
