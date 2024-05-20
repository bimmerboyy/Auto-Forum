@extends('layouts.app')

@section('content')

<div class="container w-100 d-flex justify-content-center">

    <form style="width:500px"  action="{{route('login') }}" method="POST">
        @csrf
        @if(session('status'))
        <div class="alert alert-danger" role="alert">
        {{ session('status') }}
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
        </div>
        @endif

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') border border-danger @enderror"
            class="email" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
            @error('email')
            <p class="text-danger">{{ $message }}</p>
          @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Šifra</label>
            <input type="password" class="form-control @error('password') border border-danger @enderror"
             class="password" name="password" id="passwordInput">
            @error('password')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
          <button type="submit" class="btn btn-primary mb-3">Login</button>
    </form>
</div>
@endsection
