<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['posts'=>Post::all()];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['tags'=>Tag::all()];

        return view('admin.posts.create', $data);
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
            'title'=>'required|max:255',
            'content'=>'required'
        ]);

        $data = $request->all();

        $newPost = new Post;

        $newPost->fill($data);

        $slug = Str::slug($newPost->title);
        $slug_base = $slug;
        $post_present = Post::where('slug', $slug)->first();
        $counter=1;
        while($post_present) {
            $slug = $slug_base.'-'.$counter;
            $counter++;
            $post_present = Post::where('slug', $slug)->first();
        }

        $newPost->slug = $slug;

        $newPost->user_id = Auth::id();

        $newPost->save();

        // controllo se sono stati selezionati dei tag
        if (array_key_exists('tags', $data)) {
            // aggiungo i tag al post
            $newPost->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (!$post) {
            abort(404);
        }
        $data = [
            'post'=>$post,
            'tags'=>Tag::all(),
        ];

        return view('admin.posts.edit', $data);
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
            'title'=>'required|max:255',
            'content'=>'required'
        ]);

        $data = $request->all();

        //se cambio il titolo si modifica lo slug
        if ($data['title'] != $post->title) {
            $slug = Str::slug($data['title']);
            $slug_base = $slug;
            $post_present = Post::where('slug', $slug)->first();
            $counter=1;
            while($post_present) {
                $slug = $slug_base.'-'.$counter;
                $counter++;
                $post_present = Post::where('slug', $slug)->first();
            }

            $data['slug'] = $slug;
        }

        $post->update($data);

        //aggiorno i tag in base al select
        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
