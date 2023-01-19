<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //categories

    public function categories()
    {
        //
        $categories=Category::all();

        return responseJson(1,'success',$categories);
    }

    public function storeCategory(Request $request)
    {
        //
        $validator=validator()->make($request->all(),[
            'name'=>'required|unique:categories'
        ]);
        if($validator->fails()){
        return responseJson(0,$validator->errors()->first(),$validator->errors());
            }

        $category=Category::create($request->all());
        return responseJson(1,'success',$category);

    }


    // posts

    public function posts(Request $request){
        $posts=Post::query();
        $posts=$posts->when($request->filled('category_id'), function ($q) use($request) {
             return $q->where('category_id',$request->category_id );
            })->when($request->filled('search'),function($q){
                return $q->where('title', 'like', '%' . request('search') . '%')
                         ->orWhere('image', 'like', '%' . request('search') . '%');
           })->get();
        // $posts=Post::where(function($query) use($request){
        //      if($request->has('category_id')){
        //         return $query->where('category_id',$request->category_id);
        //      }
        //      if($request->has('search')){
        //         return $query->where('title', 'like', '%' . request('search') . '%')
        //                      ->orWhere('image', 'like', '%' . request('search') . '%');
        //      }
        // })->get();
        return responseJson(1,'success',$posts);
    }
    
    public function show($id){
        $post=Post::find($id);
        if($post){
        return responseJson(1,'success',$post);
        }
        else{
        return responseJson(0,'faild to find this post',$post);
           }
    }

    public function toggleFavourite(Request $request){
        // validation
        $favpost=$request->user()->favPosts()->toggle($request->get('post_id'));
        if(count($favpost['attached']) > 0){
            return responseJson(1,'added to favourites successfully ',$favpost);
        }
        if(count($favpost['detached']) > 0){
            return responseJson(1,'removed from favourites successfully ',$favpost);
        }

        
    }

    public function favourites(Request $request){
        $favposts = $request->user()->favPosts()->paginate();
        return responseJson(1,'success',$favposts);
    }

    
}
