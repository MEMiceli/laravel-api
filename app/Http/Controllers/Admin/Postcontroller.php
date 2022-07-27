<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;

class Postcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|string|max:255',
            'content'=> 'required|string',
            'published'=> 'sometimes|accepted',
            'category_id'=>'nullable|Exists:categories,id',
            'tags'=>'nullable|Exists:tags,id',
        ]);

        $data = $request->all();
        $newPost = new Post();
        $newPost->fill($data);
        $newPost->slug = Str::of($data['title'])->slug('-');
        $newPost->published = isset($data['published']);
        $newPost->save();

        if(isset($data['tags'])) {
            $newPost->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', $newPost->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        //  serve a salvare l'old del tags nell'edit
        $postTags = $post->tags->map(function ($item)
        {
            return $item->id;
        })->toArray();

        return view('admin.posts.edit', compact('post','categories', 'tags', 'postTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=> 'required|string|max:255',
            'content'=> 'required|string',
            'published'=> 'sometimes|accepted'
        ]);

        $data = $request->all();

        if( $post->title != $data['title']) {
            $post->slug = Str::of($data['title'])->slug('-');
        }
        $post->fill($data);

        $post->published = isset($data['published']);

        $post->save();

        $tags = isset($data['tags']) ? $data['tags'] : [];

        $post->tags()->sync($tags);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
