@extends('layouts.app')

@section('page-title', 'Create exercise')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Create a new exercise</h1>
                <form action="{{route('exercises.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label class="mt-2" for="title">Title*</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text"
                           id="title" name="title"
                           placeholder="Type the title of the exercise"
                           value="{{old('title')}}">
                    @error('title')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <label class="mt-2" for="subtitle">Subtitle*</label>
                    <textarea class="form-control @error('subtitle') is-invalid @enderror"
                              id="subtitle" name="subtitle"
                              placeholder="Type the subtitle of the exercise">{{old('subtitle')}}</textarea>
                    @error('subtitle')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <label class="mt-2" for="description">Description*</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description"
                              name="description"
                              placeholder="Type the description of the exercise">{{old('description')}}</textarea>
                    @error('description')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <h3 class="mt-2">Category's</h3>
                    <div class="row">
                        @foreach($tags as $tag)
                            <div>
                                <input class="form-check-input" type="checkbox" name="tags[]" id="tag{{$tag->id}}"
                                       value="{{$tag->id}}">
                                <label class="form-check-label" for="tag{{$tag->id}}">{{$tag->name}}</label>
                            </div>
                        @endforeach
                        @error('tags') <div class="alert alert-danger">{{$message}}</div> @enderror
                    </div>
                    <input class="btn btn-primary mt-3" type="submit" value="Create Exercise">
                </form>
            </div>
            <a href="{{route('exercises.index')}}">Go Back</a>
        </div>
    </div>
@endsection
