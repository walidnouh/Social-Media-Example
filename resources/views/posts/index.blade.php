
@extends('layouts\app')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-8">
<h1>List of Posts</h1>
   <ul>
      @foreach ($posts as $post)
      @foreach ($post->comment as $comment)
         <li>
            @if($post->created_at->diffInHours()<1)
               <x-badge type="success">New</x-badge>
            @else
               <x-badge type="dark">Old</x-badge>
            @endif
            <a href="{{ route('posts.show',$post->id) }}"><h3>{{ $post->title }}</h3></a>
            <img src="{{ Storage::url($post->image->path ?? null) }}" class="img-fluid" alt="img">
               <p>{{$comment->content}}</p>
                  <form action="{{ route('posts.destroy',$post->id) }}" method="post">
                     @csrf
                     @method('DELETE')
                     @can('delete',$post)
                        <button type="submit" class="btn btn-danger">Delete</button>
                     @endcan
                     @cannot('delete',$post)
                        <span class="">you are not the admin!!</span>   
                     @endcannot      
                  </form>
                  @can('update',$post)
                     <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary">Update</a>
                  @endcan
                  <br>
               {{-- <x-updated :date="$comment->updated_at" :name="$post->user->name" :user_id="$post->user->id"></x-updated> --}}
                {!! 'Created by : <a href='.route("users.show",['user'=>$post->user->id]).'>' .$post->user->name. '</a>' !!}
               <x-tag :tags="$post->tags"></x-tag>
         </li>
      @endforeach
      @endforeach
   </ul>
</div>

<div class="col-4">
   <x-card
      title="Most commented">
         @foreach ($mostCommented as $post)
            <a href="{{ route('posts.show',$post->id) }}"> <li class="list-group-item" >{{ $post->title }}</li> </a>
         @endforeach
   </x-card>

   
   <x-card
      title="Most User Commented" 
      :items="collect($mostUsersActive)->pluck('name')" >
   </x-card>


   <x-card
      title="Most User Commented In Last Months" 
      :items="collect($mostUserActiveInLastMonths)->pluck('name')" >
   </x-card>
   
</div>
</div>
</div>
@endsection