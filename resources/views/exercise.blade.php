@extends('layouts.app')

@section('page-title', $exercise->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Details</h1>
                <div class="card">
                    <div class="card-header">
                        <h2>{{$exercise->title}}</h2>
                    </div>
                    <div class="card-body">
                        <p>{{$exercise->subtitle}}</p>
                        <p class="border-top border-bottom pt-4 pb-4">{{$exercise->description}}</p>
                        <div class="flex-row justify-content-start">
                            @foreach($exercise->tags as $tag)
                                <span class="border rounded p-2 m-0 bg-dark-subtle me-3">
                                    {{$tag->name}}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('exercises.index')}}">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
