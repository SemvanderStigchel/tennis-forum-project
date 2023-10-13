<div class="card-header">
    <h2>{{$exercise->title}}</h2>
</div>
<div class="card-body">
    <p>{{$exercise->subtitle}}</p>
    @foreach($exercise->tags as $tag)
        <span class="border rounded p-2 m-0 bg-dark-subtle me-3">
            {{$tag->name}}
        </span>
    @endforeach
</div>
