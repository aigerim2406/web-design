<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagazinController extends Controller
{

    public function rate(Request $request, Post $post){
        $request->validate([
            'rating' => 'required|min:1|max:5'
        ]);

        $postsRated = Auth::user()->postsRated()->where('post_id', $post->id)->first();

        if($postsRated != null){
            Auth::user()->postsRated()->updateExistingPivot($post->id, ['rating' => $request->input('rating')]);

        }else{
            Auth::user()->postsRated()->attach($post->id, ['rating' => $request->input('rating')]);
        }

        return back();
    }

    public function postsByCat(Category $category){
        $posts = $category->posts;
        return view('posts.index', ['posts'=>$posts, 'categories' => Category::all()]);
    }

    public function index(){
        $allPosts = Post::all();
        return view('posts.index', ['posts'=>$allPosts, 'categories' => Category::all()]);
    }

    public function create(){
        $this->authorize('create', Post::class);
        return view('posts.create', ['categories' => Category::all()]);
    }

    public function store(Request $req){
        $validated = $req->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
            'img' => 'required|image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'
        ]);

        $fillname = time().$req->file('img')->getClientOriginalName();
        $image_path = $req->file('img')->storeAs('posts', $fillname ,'public');
        $validated['img'] = '/storage/'.$image_path;
//        dd($validated);
        Auth::user()->posts()->create($validated);
        return redirect()->route('posts.index')->with('message', 'Post saktaldy');
    }

    public function show(Post $post){

        $post->load('comments.user');
        $myRating = 0;
        $postRated = Auth::user()->postsRated()->where('post_id', $post->id)->first();
        if($postRated != null)
            $myRating = $postRated->pivot->rating;

        $avgRating = 0;
        $sum = 0;
        $ratedUsers = $post->usersRated()->get();
        foreach ($ratedUsers as $ru){
            $sum += $ru->pivot->rating;
        }
        if(count($ratedUsers) > 0)
            $avgRating = $sum/count($ratedUsers);

        return view('posts.show', ['post' => $post, 'myRating' => $myRating, 'avgRating' => $avgRating, 'categories' => Category::all()]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', ['post' => $post, 'categories' => Category::all()]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id'
        ]);
        $post->update($validated);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function office(){
        return view('posts.profile');
    }
}
