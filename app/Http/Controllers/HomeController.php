<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function index()
    {
        $news = News::where('visibility', 'public')->orderBy('date', 'desc')->get();

        if (auth()->check()) {
            $privateNews = News::where('visibility', 'private')->orderBy('date', 'desc')->get();
            $news = $news->merge($privateNews);
        }

        return view('home', compact('news'));
    }
}
