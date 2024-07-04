<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function create()
    {
        if (auth()->user()->usertype == 'admin' || auth()->user()->usertype == 'moderator') {
            return view('news.create');
        }
        return redirect()->route('profile.index')->with('error', 'You do not have permission to create news.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visibility' => 'required|in:public,private',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;
        $news->date = $request->date;
        $news->visibility = $request->visibility;
        $news->user_id = auth()->id();

        if ($request->hasFile('picture')) {
            $filePath = $request->file('picture')->store('news_pictures', 'public');
            $news->picture = $filePath;
        }

        $news->save();


        return redirect()->route('home')->with('success', 'News created successfully.');
    }

}
