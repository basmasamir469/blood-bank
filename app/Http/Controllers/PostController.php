<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\traits\ImageTrait;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::with('category')->paginate(10);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::all();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
        if($request->hasFile('image')){
           $image=$this->storeImage($request->image,'images/posts');
        }
        Post::create([
            'title'=>$request->title,
            'image'=>$image,
            'content'=>$request->content,
            'category_id'=>$request->category_id
        ]);
        flash('Post stored successfully')->success();
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       $post= Post::find($id);
       return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::find($id);
        $categories=Category::all();
        return view('posts.edit',compact('categories','post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id)
    {
        //
        $post=Post::find($id);
        if($request->hasFile('image')){
            $image=$this->storeImage($request->image,'images/posts');
         }
         $post->update([
             'title'=>$request->title,
             'image'=>$image,
             'content'=>$request->content,
             'category_id'=>$request->category_id
         ]);
         flash('Post updated successfully')->success();
         return Redirect::to('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);
        $post->delete();
        flash('Post deleted successfully')->success();
        return Redirect::to('/admin/posts');
    }
}
