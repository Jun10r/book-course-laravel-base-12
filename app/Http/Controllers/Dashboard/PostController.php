<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\PutRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::paginate(2);
        return view('dashboard.post.index', compact('posts'));
        // $category = Category::find(2);
        // dd($category->posts);
        /*
        $post->update(
            [
                'title' => 'test updated',
                'slug' => 'test slug new',
                'content' => 'test content',
                'image' => 'test image',
            ]
        );
        dd($post);

        Post::create(
            [
                'title' => 'test title to remove',
                'slug' => 'test slug',
                'content' => 'test content',
                'category_id' => 1,
                'description' => 'test description',
                'posted' => 'not',
                'image' => 'test image',
            ]
        );*/
        return 'INDEXX';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id','title');
        $post = new Post();

        return view('dashboard.post.create', compact('categories','post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

         Post::create($request->validated());
         return to_route('post.index');

        // $request->validate([
        //     'title' => 'required|min:5|max:500',
        //     'slug' => 'required|min:5|max:500',
        //     'content' => 'required|min:7',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required',
        // ]);

        // Post::create(
        //     [
        //         'title' => $request->all()['title'],
        //         'slug' => $request->all()['slug'],
        //         'content' => $request->all()['content'],
        //         'category_id' => $request->all()['category_id'],
        //         'description' => $request->all()['description'],
        //         //'posted' =>  $request->all()['posted']
        //     ]
        // );

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)

    {
        dd($post);
        return view('dashboard.post.show', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id','title');

        return view('dashboard.post.edit', compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {

        $data = $request->validated();
        //image
        if(isset($date['image'])){
            $data['image'] = $filename = time().".".$data['image']->extension();
            $request->image->move(public_path('uploads\posts'),$filename);
        }

        $post->update($data);
        return to_route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index');
    }
}
