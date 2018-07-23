<?php

namespace App\Http\Controllers;


use DB;
use App\Tag;
use App\Post;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;

class PostController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::latest()->get([ 'slug', 'title', 'is_published' ]);

        return view('backend.post.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('backend.post.create');
    }

    /**
     * @param StorePost $request
     * @return mixed
     */
    public function store(StorePost $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();
            
            $post = Post::create($data);

            $this->uploadRequestImage($request, $post);

        });

        return redirect()->route('post.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Post' ]));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view($post->view, compact('post'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        

        return view('backend.post.edit',compact('post'));
    }

    /**
     * @param UpdatePost $request
     * @param Post $post
     * @return mixed
     */
    public function update(UpdatePost $request, Post $post)
    {
        DB::transaction(function () use ($request, $post)
        {
            $data = $request->data();

            $post->update($data);

            $this->uploadRequestImage($request, $post);
        });

        return redirect()->route('post.index')->withSuccess(trans('messages.Update_success', [ 'entity' => 'Post' ]));
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function destroy(Post $post)
    {
        
        $post->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'Post' ]));
    }
}

