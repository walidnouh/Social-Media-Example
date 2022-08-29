<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Cache;
        

class PostTagController extends Controller
{
    public function index($id){

        $tag = Tag::find($id);
        return view('posts.index',[
            'posts'=>$tag->posts,
        ]);
    }
}
