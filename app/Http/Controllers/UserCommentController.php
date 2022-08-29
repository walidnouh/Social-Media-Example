<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;
use App\Models\User;

class UserCommentController extends Controller
{
    public function store(StoreComment $request, User $user){
        
        $user->comment()->create([
            'content'=>$request->content,
            'user_id'=>$request->user()->id
        ]);

        return redirect()->back();
        // return redirect('post.show',['post'=>$post->id]);
    }
}
