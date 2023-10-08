@extends('layouts.app')

@section('page-title', $exercise->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Details</h1>
                <div class="card">
                    @include('partials.show-exercise')
                    <div class="card-footer">
                        <a href="{{route('exercises.index')}}">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
