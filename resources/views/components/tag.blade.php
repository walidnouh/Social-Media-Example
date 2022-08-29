@foreach ($tags as $tag)
    <div>
        <span class="badge badge-success"><a href="{{ route('posts.tag.index',['id'=>$tag->id]) }}">{{ $tag->name }}</a></span>    
    </div>   
@endforeach