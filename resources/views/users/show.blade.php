@extends('layouts.app')
@section('content')

<form action="" method="get">
   <div class="row">
      <div class="col-md-4">
         <h5>photo de profil</h5>
         <img src="{{  Storage::url($user->image->path)  ?? null}}" alt="">
      </div>
   <div class="col-md-8">
      <h3>{{ $user->name }}</h3>
      @can('update',$user)
         <a href="{{ route('users.edit',['user'=>$user->id]) }}">Edit</a>
      @endcan
   </div>   
   </div>
</form>
@endsection