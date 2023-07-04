<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\EditPostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index() {
        $posts = Post::public()->latest()->paginate(10);
        return PostResource::collection($posts)->additional(['status' => 200, 'message' => '']);
    }

    function my_posts() {
        $posts = auth('api')->user()->posts()->latest()->paginate(10);
        return PostResource::collection($posts)->additional(['status' => 200, 'message' => '']);
    }

    function store(CreatePostRequest $request) : PostResource {
        $post = auth('api')->user()->posts()->create($request->validated());
        return PostResource::make($post)->additional(['status' => 200, 'message' => 'Post Created Successfully.']);
    }

    function update(EditPostRequest $request, Post $post) : PostResource | JsonResponse {
        if($post->user_id != auth('api')->id())
        {
            return response()->json(['status' => 401, 'data' => null, 'message' => 'Unauthorized.']);
        }
        $data = collect($request->all())->filter()->toArray();
        $post->update($data);
        return PostResource::make($post)->additional(['status' => 200, 'message' => 'Post Created Successfully.']);
    }

    function destroy(Post $post) : JsonResponse {
        if($post->user_id != auth('api')->id())
        {
            return response()->json(['status' => 400, 'data' => null, 'message' => 'Unauthorized.']);
        }
        $post->delete();
        return response()->json(['status' => 400, 'data' => null, 'message' => 'Post Deleted Successfully.']);
    }
}
