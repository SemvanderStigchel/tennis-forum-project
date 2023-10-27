@extends('layouts.app')

@section('page-title', 'Exercises')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <h1 class="col">Exercises</h1>
                <form class="col" action="{{route('exercises.search')}}" method="GET">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Search an exercise"
                                   aria-label="Search bar" name="search" value="{{Request::get('search')}}">
                        </div>
                        <div class="col">
                            <input type="submit" class="btn btn-outline-dark" value="Search">
                        </div>
                    </div>
                    <div class="row mt-2 flex-wrap">
                        <p class="col m-0 p-0">Filters:</p>
                        @foreach($tags as $tag)
                            <div class="col p-0">
                                <input class="form-check-input" type="checkbox" name="filters[]" id="tag{{$tag->id}}"
                                       value="{{$tag->id}}" @if(collect($filters)->contains($tag->id)) checked @endif>
                                <label class="form-check-label" for="tag{{$tag->id}}">{{$tag->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
            @foreach($exercises as $exercise)
                <div class="col-md-5 mt-5">
                    <div class="exercise card">
                        @include('partials.show-exercise')
                        <div class="card-footer column flex-nowrap">
                            @guest
                                <a class="btn btn-primary" href="{{route('exercises.show', $exercise)}}">More
                                    Details</a>
                            @else
                                <div class="row gap-1">
                                    <a class="btn btn-primary col" href="{{route('exercises.show', $exercise)}}">More
                                        Details</a>
                                    @if(Auth::user()->id === $exercise->user_id)
                                        <a class="btn btn-primary col"
                                           href="{{route('exercises.edit', $exercise)}}">Edit</a>
                                        <form class="col p-0" action="{{route('exercises.destroy', $exercise)}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger delete w-100" type="submit">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
