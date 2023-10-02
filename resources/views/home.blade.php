@extends('layouts.app')

@section('page-title', 'Logged In')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>

                    <div class="card-body">
                        <a href="{{route('exercises.index')}}">Alle oefeningen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
