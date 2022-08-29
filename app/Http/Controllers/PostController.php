<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Image as ModelsImage;
use App\Models\Post;
use App\Scopes\LatestScope;

use Illuminate\Http\Request;
use Cache;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index',
            [
                'posts'=>\App\Models\Post::withCount('comment')->with(['comment','tags'])->get(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create');
        return view('posts.addpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'=>'required|min:4|max:100',
        ]); 

        $validatedData['user_id']=Auth::user()->id;

        $post=Post::create($validatedData);

        if($request->hasFile('picture')){
            
            $path = $request->file('picture')->store('posts');

            $image = new \App\Models\Image(['path'=>$path]);

            $post->image()->save($image);
        }

        return redirect()->route('posts.show',['post'=>$post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::whereId($id)->with('user','comment')->first();
        return view('posts.show',compact(['post']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.update',compact('post')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title'=>'required|min:4|max:100',
        ]); 

        $validatedData['user_id']=Auth::user()->id;

        $post = Post::findOrFail($id);

        $this->authorize("update",$post);

        //update image :
        if($request->hasFile('picture')){
            $path = $request->file('picture')->store('posts');
            if($post->image){
                Storage::delete($post->image->path);
                $post->image->save();
            }
            else{
                $post->image->save(Image::create(['path'=>$path]));
            }
        }
        //end update;

        $post->fill($validatedData);
        $post->save();

        $request->session()->flash('status','blog was updated');

        return redirect()->route('posts.show',['post'=>$post->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = \App\Models\Post::where('id',$id)->first();
        $this->authorize("post.update",$post);
        $post->delete();
        return redirect()->route('posts.index')->with(['success'=>'Article supprimer']);
    }
}
