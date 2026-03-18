<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;

class PostService
{

    public function getPosts()
    {
        return Post::where('user_id', Auth::user()->id)->paginate(10);
    }

    public function createPosts($data)
    {
        $fields = [
            'user_id' => Auth::user()->id,
            'title' => $data['title'],
            'subtitle' => $data['subtitle'],
            'body' => $data['body'],
            'is_published' => $data['is_published'],
            'published_at' => $data['published_at'],
        ];
        return Post::create($fields);
    }

    public function updatePost($data, $id)
    {
        $post = Post::findOrFail($id);
        if (Gate::denies('update', $post)) {
            abort(403, 'You do not own this post.');
        }
        return $post->update($data);
    }

    public function deleteUser($id)
    {
        $post = Post::findOrFail($id);
        if (Gate::denies('forceDelete', $post)) {
            abort(403, 'You do not own this post.');
        }
        $post->delete();
        return $post;
    }
}
