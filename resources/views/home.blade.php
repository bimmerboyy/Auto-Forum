@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Novosti</h1>

        @foreach($news as $newsItem)
            @php
                $imagePath = asset('storage/' . $newsItem->picture);
            @endphp
            <div class="news-item">
                <h2>{{ $newsItem->title }}</h2>
                @if ($newsItem->picture)
                    <img src="{{ $imagePath }}" alt="{{ $newsItem->title }}" style="width:100%; height:500px;">
                @else
                    <p>Slika nije dostupna</p>
                @endif
                {{-- <p>{{ $newsItem->content }}</p> --}}
                <div class="text" style="width:100px;">
                    {{ $newsItem->content }}
                </div>
                <p><small>Postavljeno {{ \Carbon\Carbon::parse($newsItem->date)->format('d M Y') }}</small></p>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
