@extends('layouts.app')

@section('page-title', 'Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Profile</h1>
            <div class="form">
                <form action="{{route('profile.update')}}" method="POST">
                    @csrf
                    @method('PUT')

                    <label class="mt-2" for="name">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                           id="name" name="name"
                           value="{{$user->name}}">
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <label class="mt-2" for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                           id="email" name="email"
                           value="{{$user->email}}">
                    @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <button class="btn btn-primary mt-3" type="submit">Update information</button>
                </form>
            </div>
        </div>
    </div>
@endsection
