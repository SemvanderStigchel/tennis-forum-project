@extends('layouts.app')

@section('page-title', 'Logged In')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

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
                            </div>
                        @endforeach

                        <a href="{{route('create')}}">Create pagina</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
