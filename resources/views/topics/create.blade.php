@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Napravi Temu</h1>

        <form action="{{ route('topics.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Naslov</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="form-group">
                <label for="description">Opis</label>
                <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
            </div>
            <button type="submit" @if(auth()->user()->usertype == 'user') style="visibility:hidden" @endif style="margin-top:20px;" class="btn btn-primary">Napravi</button>
        </form>
    </div>
@endsection
