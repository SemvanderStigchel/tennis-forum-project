@extends('layouts.app')

@section('page-title', 'Create exercise')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="" method="POST">
                    @csrf
                    <label for="title">Titel</label>
                    <input type="text" id="title" name="title" placeholder="Titel van de oefening">

                    <label for="description">Uitleg</label>
                    <textarea id="description" name="description" placeholder="Typ hier de uitleg van de oefening."></textarea>

                    <label for="image">Voeg een foto toe</label>
                    <input type="image" name="image" id="image" alt="submitted image">

                    <h2>Categoriën</h2>
                    @foreach($tags as $tag)
                        <label for="tag{{$tag->id}}">{{$tag->name}}</label>
                        <input type="checkbox" name="tag{{$tag->id}}" id="tag{{$tag->id}}">
                    @endforeach

                    <input type="submit" value="Maak oefening">
                </form>
            </div>
        </div>
    </div>
@endsection
