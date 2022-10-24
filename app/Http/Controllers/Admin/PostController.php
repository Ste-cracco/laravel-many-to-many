<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::limit(60)->get();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get(); // Ricordare di importare il namespace della classe Category -> use App\Category;
        
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required | max:255 | min:5',
            'content' => 'required',
            'category_id' => 'nullable | exists:App\Category,id' // Ricordarsi di aggiungerlo al 'fillable'
        ]);

        // Aggiungo controllo nella quale lo slug sia univoco
        // Richiamo il metodo statico 'getUniqueSlugFrom' creato in Post.php

        $params['slug'] = Post::getUniqueSlugFrom($params['title']);

        $post = Post::create($params);

        return redirect()->route('admin.post.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name', 'asc')->get(); // Ricordare di importare il namespace della classe Category -> use App\Category;
        
        return view('admin.post.edit', compact('categories', 'post')); // Gli passo $post per poter stampare i date nelle views
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
        $params = $request->validate([
            'title' => 'required | max:255 | min:5',
            'content' => 'required',
            'category_id' => 'nullable | exists:App\Category,id' // Ricordarsi di aggiungerlo al 'fillable'
        ]);

        // Aggiungo controllo: Se 'title' è diverso dalla proprietà title di $post allora rigeneriamo lo slug

        if($params['title'] !== $post->title) {

            // Richiamo il metodo statico 'getUniqueSlugFrom' creato in Post.php

            $params['slug'] = Post::getUniqueSlugFrom($params['title']);
        }

        $post->update($params);

        return redirect()->route('admin.post.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        {
            $post->delete();
    
            return redirect()->route('admin.post.index');
        }
    }
}
