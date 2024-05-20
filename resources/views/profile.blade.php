@extends('layouts.app')

@section('content')
@if(auth()->user()->usertype == 'admin')
<h1>Welcome Admin!</h1>
@elseif(auth()->user()->usertype == 'moderator')
<h1>Welcome Moderator!</h1>
@else
<h1>Welcome User!</h1>
@endif
@endsection
