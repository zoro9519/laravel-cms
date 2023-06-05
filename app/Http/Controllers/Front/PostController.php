<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    // Get post by it's slug
    public function getPostBySlug($slug)
    {
        // I've Pass Slug to Get the Category per it's Slug
        $post = Post::with(['category', 'user'])->whereStatus(true)->whereSlug($slug)->firstOrFail();
        $comments = $post->comments;
        $post_title = $post->title;

        if (!Cookie::get('post_viewed_' . $post->id)) {
            // Update view counter of post
            $post->views = (int) $post->views + 1;
            $post->save();
            // Create a cookie and set it for 1 day
            Cookie::queue('post_viewed_' . $post->id, true, 60 * 24);
        }

        return view('post', compact('post', 'post_title', 'comments'));
    }

}
