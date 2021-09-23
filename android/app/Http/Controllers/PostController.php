<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function create(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'message'=>'required'
        ]);

        $user = auth()->user();
        $post = $this->post->create([
            'user_id'=>$user->id,
            'title'=>$request['title'],
            'message'=>$request['message']
        ]);
        if ($post)

        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);

    }

    public function index(){

        $post = $this->post->with('user')
            ->where('user_id', auth()->user()->id)->latest()
            ->paginate(20);

        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }

    public function show($id){

        $post = $this->post->where('id',$id)->with(['user'])->first();
        if (!$post){
            return response()->json([
                'status_code' => 404,
                'message' => 'Post not found'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);

    }

}
