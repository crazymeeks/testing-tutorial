<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::create([
                'title'   => $request->post('title'),
                'content' => $request->post('content')
            ]);

        return response()->json([
            'message' => 'Post successfully created'
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'      => 'required',
            'title'   => 'required',
            'content' => 'required'
        ]);

        $post = Post::find($request->post('id'));

        $post->title   = $request->post('title');
        $post->content = $request->post('content');

        $post->save();

        return response()->json([
            'message' => 'Post successfully updated',
            'post_id' => $post->id,
            'title'   => $post->title,
            'content' => $post->content
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
