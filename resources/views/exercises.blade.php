@extends('layouts.app')

@section('page-title', 'Exercises')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <h1>Exercises</h1>
            @foreach($exercises as $exercise)
                <div class="col-md-5 mt-5">
                    <div class="exercise card">
                        @include('partials.show-exercise')
                        <div class="card-footer column flex-nowrap">
                            @guest
                                <a class="btn btn-primary" href="{{route('exercises.show', $exercise)}}">More
                                    Details</a>
                            @else
                                <a class="btn btn-primary" href="{{route('exercises.show', $exercise)}}">More
                                    Details</a>
                                @if(Auth::user()->id === $exercise->user_id)
                                    <a class="btn btn-primary"
                                       href="{{route('exercises.edit', $exercise)}}">Edit</a>
                                    <form class="w-25" action="{{route('exercises.destroy', $exercise)}}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
