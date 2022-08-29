@extends('layouts.app')
@section('content')

<form action="{{ route('users.update',[Auth::user()->id]) }}" method="POST"  enctype="multipart/form-data">
   @csrf
   @method('PUT')
<div class="row mb-3">
   <label class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
   <div class="col-md-6">
       <input name="title" type="text" class="form-control"  >
   </div>
</div>

<div class="row mb-3">
   <label  class="col-md-4 col-form-label text-md-end">{{ __('Picture') }}</label>
   <div class="col-md-6">
       <input  type="file" name="avatar" value="Add Post" 2>
       <br>
       <br>
   <input type="submit" class="btn btn-primary" value="Update">
   </div>
</div>

</form>
@endsection