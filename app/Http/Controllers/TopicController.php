<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        $users = User::all(); // Get all users to pass to the view

        return view('topics.index', compact('topics', 'users'));
    }

    public function show($id)
    {
        $topic = Topic::with(['posts.user', 'posts.replies.user', 'followers'])->findOrFail($id);

        if ($topic->status === 'closed') {
            return redirect()->route('topics.index')->with('error', 'This topic is closed.');
        }

        return view('topics.show', compact('topic'));
    }


    public function create()
    {
        if (Auth::user()->usertype != 'admin' && Auth::user()->usertype != 'moderator') {
            return redirect()->route('topics.index')->with('error', 'You do not have permission to create a topic.');
        }

        return view('topics.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->usertype != 'admin' && Auth::user()->usertype != 'moderator') {
            return redirect()->route('topics.index')->with('error', 'You do not have permission to create a topic.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('topics.index')->with('success', 'Topic created successfully.');
    }


    public function close($id)
    {
        $topic = Topic::findOrFail($id);

        if (auth()->user()->usertype == 'admin' || auth()->user()->usertype == 'moderator') {
            $topic->status = 'closed';
            $topic->save();
            return redirect()->route('topics.index')->with('success', 'Topic closed successfully.');
        }

        return redirect()->route('topics.index')->with('error', 'You do not have permission to close this topic.');
    }


    public function storePost(Request $request, $id)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $topic = Topic::findOrFail($id);

        $post = new Post();
        $post->content = $request->content;
        $post->topic_id = $topic->id;
        $post->user_id = auth()->id();
        $post->save();

        return redirect()->route('topics.show', $id);
    }

    public function follow($id)
    {
        $topic = Topic::findOrFail($id);

        if ($topic->status === 'closed') {
            return redirect()->back()->with('error', 'This topic is closed. You cannot follow it.');
        }

        $user = auth()->user();
        $topic->followers()->attach($user->id);

        return redirect()->back()->with('success', 'You are now following this topic.');
    }

    public function unfollow($id)
    {
        $topic = Topic::findOrFail($id);
        $user = auth()->user();
        $topic->followers()->detach($user->id);

        return redirect()->back()->with('success', 'You have unfollowed this topic.');
    }
    public function banUser(Request $request)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'topic_id' => 'required|exists:topics,id',
    ]);

    $user = User::findOrFail($request->user_id);
    $topic = Topic::findOrFail($request->topic_id);

    // Unfollow the user from the topic
    $topic->followers()->detach($user->id);

    // Ban the user from the topic
    $topic->bannedUsers()->attach($user->id);

    return redirect()->route('topics.index')->with('success', 'User has been banned from the topic.');
    }
    public function bannedUsers()
    {
    return $this->belongsToMany(User::class, 'banned_topic_user', 'topic_id', 'user_id');
    }



}
