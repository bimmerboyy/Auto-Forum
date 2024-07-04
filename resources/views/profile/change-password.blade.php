@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Promeni Sifru</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.change-password.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">Nova Sifra</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Potvrdi Novu Sifru</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Promeni Sifru</button>
        </form>
    </div>
@endsection
