@extends('layouts\app')

@section('content')

<div class="container">

   <div class="row">

      <div class="col-8">
         
            <h1>{{ $post->title }}</h1>

            <img src="{{ Storage::url($post->image()->path ?? null) }}" class="img-fluid" alt="">

            <h2>{{ $post->created_at }}</h2>

            <x-tag :tags="$post->tags"></x-tag>

            {{-- <x-updated :date="$post->updated_at" :name="$post->user_id" ></x-updated> --}}

            <div>
               @auth
                  <form action="{{ route('posts.comments.store',[$post->id]) }}" method="post">
                     @csrf
                     <textarea class="form-control" name="content" id="content" cols="30" rows="3"></textarea>
                     <input class="btn btn-primary btn-block mt-2" type="submit" value="Add Comment">
                  </form>
               @endauth
            </div>

            {{-- @include('comments.form',['id'=> $post->id]) --}}

            @foreach ($post->comment as $comment)

            <span> Created by,{{ $comment->user->name }}</span>

            <p>{{ $comment->content }}</p>

            <x-updated :date="$comment->updated_at" :name="$comment->user->name" ></x-updated>

            @endforeach
            
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
