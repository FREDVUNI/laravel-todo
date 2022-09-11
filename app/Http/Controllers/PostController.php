<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    public function __construct(){
       // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::orderBy('created_at','DESC')->get();
        return request()->json(200,$posts);
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
        $valid = Validator::make($request->all(),[
            "title" => "required|max:250|unique:posts",
            "description" => "required",
            "image" => "required|image|mimes:jpg,jpeg,png,gifs|max:2048"
        ]);
        if($valid->fails()):
            return response()->json(
                ["error" =>$valid->errors()],
                401
            );
        endif;
        $newPost = new Post;

        $image = $request->file('image');
        $file = rand() .".".$image->getClientOriginalExtension();
        $image->move(public_path("/images"),$file);

        $newPost->title = $request->title;
        $newPost->description = $request->description;
        $newPost->user_id = $request->user_id;
        $newPost->image = $file;

        $newPost->save();
        return $newPost;

        /*$data = request()->validate([
            "title" => "required|max:250|unique:posts",
            "description" => "required",
            "image" => "required|image|mimes:jpg,jpeg,png,gifs|max:2048"
        ]);
        $image = $request->file("image");
        $file = rand() .".".$image->getClientOriginalExtension();
        $image->move(public_path("/images"),$file);

        $post = auth()->user()->posts()->create([
            "title" => $data["title"],
            "description" => $data["description"],
            "image" => $image,
        ]);
        dd($post);
        return $post;

        /*$newpost = new Post;
        //$user_id = $post->user()->id;

        //dd($user_id);
        //dd($request->post["title"]);

        $newpost->title = $request->post["title"];
        $newpost->description = $request->post["description"];
        
        $newpost->image = $request->post["image"];
        $newpost->user_id = $request->post["user_id"];
        //$file = rand() .".".$image->getClientOriginalExtension();
        //$image->move(public_path("/images"),$file);

        //$post->$image;
        $newpost->save();
        return $newpost;
        */
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
