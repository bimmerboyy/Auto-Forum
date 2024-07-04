@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create News</h1>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Naslov</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Sadrzaj</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Datum</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div class="mb-3">
                <label for="picture" class="form-label">Slika</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>

            <div class="mb-3">
                <label for="visibility" class="form-label">Vidljivost</label>
                <select class="form-control" id="visibility" name="visibility" required>
                    <option value="public">Javno</option>
                    <option value="private">Privatno</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Napravi</button>
        </form>
    </div>
@endsection
