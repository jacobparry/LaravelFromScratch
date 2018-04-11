<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Post;
use App\Http\Resources\Post as PostResource;

class PostsAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get posts
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        // Return collection of posts as a resource
        return PostResource::collection($posts);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //For Postman
        // Post: headers: content-type = application json, raw JSON in body
        // Put: headers: content-type = application json, raw JSON in body
 
        $post = $request->isMethod('PUT') ? Post::findOrFail($request->id) : new Post;

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        $post->cover_image = $request->input('cover_image');
        
        if($post->save())
        {
            return new PostResource($post);
        }    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return new PostResource($post);   

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->delete())
        {
            return new PostResource($post);
        }  
    }
}
