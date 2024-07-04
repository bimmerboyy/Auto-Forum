<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use App\Models\Follow;
use App\Models\PostLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewPostNotification;

class PostController extends Controller
{
    public function store(Request $request, $topicId)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $topic = Topic::findOrFail($topicId);

        // Check if the user is banned from the topic
        if ($topic->bannedUsers->contains(Auth::id())) {
            return redirect()->route('topics.show', $topic->id)->with('error', 'You are banned from posting in this topic.');
        }

        $post = new Post();
        $post->content = $request->input('content');
        $post->topic_id = $topic->id;
        $post->user_id = Auth::id();
        $post->save();

        // Notify followers
        $followers = $topic->followers;
        foreach ($followers as $follower) {
            $follower->notify(new NewPostNotification($post));
        }

        return redirect()->route('topics.show', $topic->id)->with('success', 'Post created successfully.');
    }

    public function likePost($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        $topic = $post->topic;

        // Check if the user is banned from the topic
        if ($topic->bannedUsers->contains($user->id)) {
            return response()->json(['success' => false, 'message' => 'You are banned from liking posts in this topic.']);
        }

        // Check if the user has already liked the post
        $existingLike = PostLike::where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->where('type', 'like')
            ->first();

        if (!$existingLike) {
            PostLike::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'type' => 'like'
            ]);

            return response()->json(['success' => true, 'likes' => $post->likesCount()]);
        }

        return response()->json(['success' => false, 'message' => 'User has already liked this post.']);
    }

    public function dislikePost($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        $topic = $post->topic;

        // Check if the user is banned from the topic
        if ($topic->bannedUsers->contains($user->id)) {
            return response()->json(['success' => false, 'message' => 'You are banned from disliking posts in this topic.']);
        }

        // Check if the user has already disliked the post
        $existingDislike = PostLike::where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->where('type', 'dislike')
            ->first();

        if (!$existingDislike) {
            PostLike::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'type' => 'dislike'
            ]);

            return response()->json(['success' => true, 'dislikes' => $post->dislikesCount()]);
        }

        return response()->json(['success' => false, 'message' => 'User has already disliked this post.']);
    }

    public function reply(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $parentPost = Post::findOrFail($postId);
        $topic = $parentPost->topic;

        if ($topic->bannedUsers->contains(Auth::id())) {
            return redirect()->route('topics.show', $topic->id)->with('error', 'You are banned from replying to this topic.');
        }

        Post::create([
            'topic_id' => $topic->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $parentPost->id
        ]);

        return redirect()->route('topics.show', $topic->id)->with('success', 'Reply posted successfully.');
    }
}
