<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    // posts

    public function posts(){
        $posts=Post::paginate(20);
        // $posts=$posts->when($request->filled('category_id'), function ($q) use($request) {
        //      return $q->where('category_id',$request->category_id );
        //     })->when($request->filled('search'),function($q){
        //         return $q->where('title', 'like', '%' . request('search') . '%')
        //                  ->orWhere('image', 'like', '%' . request('search') . '%');
        //    })->get();
        return view('front.pages.posts',compact('posts'));
    }
    
    public function show($id){
        $posts=Post::all();
        $post=Post::findOrFail($id);
        return view('front.pages.post-details',compact('post','posts'));
    }

    public function toggleFavourite(Request $request){
        // validation
        $post=Post::find($request->post_id);
        $favpost=$request->user()->favPosts()->toggle($request->get('post_id'));
        if(count($favpost['attached']) > 0){
            return responseJson(1,'added to favourites successfully ',$favpost);
        }
        else if(count($favpost['detached']) > 0){
            return responseJson(1,'removed from favourites successfully ',$favpost);
        }
}

    public function favourites(){
        $favposts = auth('front')->user()->favPosts()->paginate();
        return view('front.pages.favposts',compact('favposts'));
    }

    
}
