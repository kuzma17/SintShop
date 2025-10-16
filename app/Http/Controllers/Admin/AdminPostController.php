<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Post::orderBy('updated_at', 'desc')->get();
        return view('admin.posts.index', ['posts' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, ImageService $imageService)
    {
        if(!$request->active){
            $request['active'] = 0;
        }
        $image = $request->files->get('file');
        if ($image){;
            $request['image'] = $imageService->create($image, '', 400, 300, 'images/posts');
        }

        $post = Post::create($request->all());
        $post->seo()->create($request->input('seo'));

        return redirect(route('admin.posts.index'));
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
    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post, ImageService $imageService)
    {
        if(!$request->active){
            $request['active'] = 0;
        }

        $image = $request->files->get('file');
        if ($image){;
            $request['image'] = $imageService->create($image, '', 400, 300, 'images/posts');
        }

        $post->update($request->all());
        $post->seo()->update($request->input('seo'));

        return redirect(route('admin.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
