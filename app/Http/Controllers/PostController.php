<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->limit)
            $posts = Post::with('user')->orderBy('created_at', 'DESC')->take($request->limit)->get();
        else $posts = Post::with('user')->get();
        if($request->return_post_count){
            $posts_count = $posts->count();
            return response()->json(
                [
                    'status' => 'success',
                    'posts_count' => $posts_count,
                ], 200);
        }
        return response()->json(
            [
                'status' => 'success',
                'posts' => $posts->toArray(),
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->caption = $request->caption;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        if($request->hasFile('image')){
            $filenameWithExt=$request->file('image')->getClientOriginalName();
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension=$request->file('image')->getClientOriginalExtension();
            $filenameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/images/post_images', $filenameToStore);
        }
        else {
            $filenameToStore="noimage.jpg";
        }
        $post->image = $filenameToStore;
        $post->save();
        return response([
            'status' => 'success',
            'data' => $post
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(
            [
                'status' => 'success',
                'post' => $post->toArray()
            ], 200);
    }
}
