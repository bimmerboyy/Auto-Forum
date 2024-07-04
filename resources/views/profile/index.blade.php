@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profil</h1>

        <!-- User Info -->
        <div class="user-info mb-3">
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" style="width: 150px;">
            <p style="margin-top:10px;"><strong>Ime:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Broj Telefona:</strong> {{ auth()->user()->phone_number }}</p>
        </div>

        <!-- Only show the button to admin and moderators -->
        @if(auth()->user()->usertype == 'admin' || auth()->user()->usertype == 'moderator')
            <a style="margin-top:15px;" href="{{ route('news.create') }}" class="btn btn-primary">Dodaj Novosti</a>
        @endif

        <!-- Change Password Button -->
        <a href="{{ route('profile.change-password') }}" class="btn btn-secondary mt-3">Promeni Sifru</a>

        @if(auth()->user()->usertype == 'admin')
        <div class="mt-5">
            <h2>Akcije Admina</h2>

            <!-- Change Status Form -->
            <form action="{{ route('profile.changeStatus') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">Odaberi Korisnika</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Odaberi Korisnika</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Odaberi Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Odaberi Status</option>
                        <option value="approved">Approved</option>
                        <option value="denied">Denied</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning mt-3">Promeni Status</button>
            </form>

            <!-- Change Usertype Form -->
            <form action="{{ route('profile.changeUsertype') }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="change_usertype_user_id">Odaberi Korisnika</label>
                    <select name="user_id" id="change_usertype_user_id" class="form-control" required>
                        <option value="">Odaberi Korisnika</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="usertype">Odabri Tip Korisnika</label>
                    <select name="usertype" id="usertype" class="form-control" required>
                        <option value="">Odabri Tip Korisnika</option>
                        <option value="user">User</option>
                        <option value="moderator">Moderator</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-info mt-3">Promeni Tip Korisnika</button>
            </form>

            <!-- Delete User Form -->
            <form action="{{ route('profile.deleteUser') }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="delete_user_id">Odaberi Korsnika za Brisanje</label>
                    <select name="user_id" id="delete_user_id" class="form-control" required>
                        <option value="">Odaberi Korisnika</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-danger mt-3">Izbrisi Korisnika</button>
            </form>
        </div>
    @endif
</div>
    </div>
@endsection
