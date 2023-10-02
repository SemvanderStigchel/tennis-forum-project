@extends('layouts.app')

@section('page-title', 'Exercises')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Exercises') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach($exercises as $exercise)
                            <div class="exercise">
                                <h2>{{$exercise->title}}</h2>
                                <p>{{$exercise->description}}</p>
                                @foreach($exercise->tags as $tag)
                                    <p>{{$tag->name}}</p>
                                @endforeach
                            </div>
                        @endforeach

                        <a href="{{route('exercises.create')}}">Create pagina</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
