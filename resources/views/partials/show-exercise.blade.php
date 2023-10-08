<div class="card-header">
    <h2>{{$exercise->title}}</h2>
</div>
<div class="card-body">
    <p>{{$exercise->description}}</p>
    @foreach($exercise->tags as $tag)
        <p>{{$tag->name}}</p>
    @endforeach
</div>
