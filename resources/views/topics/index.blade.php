@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Teme</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(auth()->user()->usertype == 'admin' || auth()->user()->usertype == 'moderator')
            <a href="{{ route('topics.create') }}" class="btn btn-primary">Napravi Temu</a>
        @endif

        <ul class="list-group mt-3">
            @foreach($topics as $topic)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('topics.show', $topic) }}">{{ $topic->title }}</a>
                    </div>
                    <div>
                        @if(auth()->user()->usertype == 'admin' || auth()->user()->usertype == 'moderator')
                            @if($topic->status === 'open')
                                <form action="{{ route('topics.close', $topic) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning btn-sm">Zatvori</button>
                                </form>
                            @endif
                        @endif
                        @if ($topic->status === 'closed')
                            <button type="button" class="btn btn-secondary btn-sm" disabled>Zaprati</button>
                        @else
                            @if ($topic->followers->contains(auth()->user()))
                                <form action="{{ route('topics.unfollow', $topic->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm">Otprati</button>
                                </form>
                            @elseif($topic->bannedUsers->contains(auth()->user()))
                                <button class="btn btn-secondary btn-sm" disabled>Ti si izbacen sa ove teme</button>
                            @else
                                <form action="{{ route('topics.follow', $topic->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Zaprati</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

        @if(auth()->user()->usertype == 'admin' || auth()->user()->usertype == 'moderator')
            <hr>
            <h2>Izbaci Korisnika sa Teme</h2>
            <form action="{{ route('topics.banUser') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user">Odaberi Korisnika</label>
                    <select name="user_id" id="user" class="form-control" required>
                        <option value="">Odaberi Korisnika</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="topic">Selektuj Temu</label>
                    <select name="topic_id" id="topic" class="form-control" required>
                        <option value="">Odaberi Temu</option>
                        @foreach($topics as $topic)
                            <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-danger mt-3">Izbaci Korisnika</button>
            </form>
        @endif


    </div>
@endsection
