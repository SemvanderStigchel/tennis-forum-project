@extends('layouts.app')

@section('page-title', 'Exercises')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Exercises</h1>
                @foreach($exercises as $exercise)
                    <div class="exercise card">
                        @include('partials.show-exercise')
                        <div class="card-footer ">
                            <a href="{{route('exercises.show', $exercise)}}">More Details</a>
                            <a href="{{route('exercises.destroy', $exercise)}}">Delete</a>
                            <a href="{{route('exercises.edit', $exercise)}}">Edit</a>
                        </div>
                    </div>
                @endforeach

                <a href="{{route('exercises.create')}}">Create page</a>
            </div>
        </div>
    </div>

@endsection
