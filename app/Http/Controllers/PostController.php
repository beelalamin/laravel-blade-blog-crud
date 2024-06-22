<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Fields;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->paginate(9),
        ]);
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
        // validate fields
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
            'image' => ['file', 'nullable', 'mimes:png,jpg,jpeg', 'max:1024'],
        ]);

        // upload image
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('post_images', $request->file('image'));
        }

        // create post
        Auth::user()->posts()->create([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'image' => $path,
        ]);

        // redirect
        return back()->with('message', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('modify', $post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);

        // validate fields
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
        ]);

        // update post
        $post->update($fields);

        // redirect
        return redirect()->route('dashboard')->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        Gate::authorize('modify', $post);

        $post->delete();

        return back()->with('deleted', 'Post deleted successfully');
    }
}
