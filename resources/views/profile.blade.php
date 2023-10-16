@extends('layouts.app')

@section('page-title', 'Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Profile</h1>
            @foreach($users as $user)
                @if(Auth::user()->id === $user->id)
                    <p class="border-bottom">User name: {{$user->name}}, Email: {{$user->email}}</p>
                    <a href="{{route('profile.edit', $user)}}" class="btn btn-primary">Update information</a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
