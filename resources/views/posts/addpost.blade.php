@extends('layouts.app')
@section('content')

<form action="{{ route('posts.store') }}" method="POST"  enctype="multipart/form-data">
   @csrf
<div class="row mb-3">
   <label class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
   <div class="col-md-6">
       <input name="title" type="text" class="form-control" >
   </div>
</div>

<div class="row mb-3">
   <label  class="col-md-4 col-form-label text-md-end">{{ __('Picture') }}</label>
   <div class="col-md-6">
       <input  type="file" name="picture" value="Add Post">
       <br>
       <br>
   <input type="submit" class="btn btn-primary" value="Ajouter">
   </div>
</div>

</form>
@endsection