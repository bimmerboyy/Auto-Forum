@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $topic->title }}</h1>
        <p>{{ $topic->description }}</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <hr>

        <h2>Posts</h2>
        @foreach($topic->posts as $post)
            <div class="post" data-post-id="{{ $post->id }}">
                <p>{{ $post->content }}</p>
                <small>Postavljeno od strane {{ $post->user->username }} on {{ $post->created_at->format('d M Y') }}</small>
                <div>
                    <button type="button" class="btn btn-primary" onclick="likePost({{ $post->id }})">Like</button>
                    <button type="button" class="btn btn-primary" onclick="dislikePost({{ $post->id }})">Dislike</button>
                    <br>
                    <span id="likes-count-{{ $post->id }}">{{ $post->likesCount() }}</span> Likes
                    <span id="dislikes-count-{{ $post->id }}">{{ $post->dislikesCount() }}</span> Dislikes
                </div>
                @if (!$topic->bannedUsers->contains(auth()->user()))
                    <button type="button" class="btn btn-secondary mt-2" onclick="showReplyForm({{ $post->id }})">Odgovori</button>
                    <div id="reply-form-{{ $post->id }}" style="display: none;">
                        <form action="{{ route('posts.reply', $post->id) }}" method="POST">
                            @csrf
                            <textarea name="content" rows="3" required></textarea>
                            <button type="submit" class="btn btn-primary">Postavi Odgovor</button>
                        </form>
                    </div>
                @endif
                @if ($post->replies)
                    <div class="replies ml-4">
                        @foreach($post->replies as $reply)
                            <div class="reply" data-reply-id="{{ $reply->id }}">
                                <p>{{ $reply->content }}</p>
                                <small>Odgovoreno od strane {{ $reply->user->username }} na {{ $reply->created_at->format('d M Y') }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <hr>
        @endforeach

        @if (!$topic->bannedUsers->contains(auth()->user()))
            <form action="{{ route('posts.store', $topic->id) }}" method="POST">
                @csrf
                <textarea name="content" rows="3" required></textarea>
                <br>
                <button type="submit" style="width:80px;">Objavi</button>
            </form>
        @else
            <p class="text-danger">Ti si izbacen i onemoguceno ti je postavljanje obajava u ovoj temi.</p>
        @endif
        @if(auth()->user()->usertype == 'admin' || auth()->user()->usertype == 'moderator')
        <a href="{{ route('polls.create', $topic->id) }}" class="btn btn-primary mt-3">Napravi Anketu</a>
        @endif


    @if ($topic->poll)
    <h3>Anketa</h3>
    <form action="{{ route('polls.vote', $topic->poll->id) }}" method="POST">
        @csrf
        @foreach ($topic->poll->questions as $question)
            <div class="form-group">
                <label>{{ $question->text }}</label>
                @foreach ($question->options as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}" required>
                        <label class="form-check-label">{{ $option->text }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Potvrdi Anketu</button>
    </form>
@endif


    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function likePost(postId) {
        fetch(`/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likesCountElement = document.getElementById(`likes-count-${postId}`);
                likesCountElement.innerText = data.likes;
            } else {
                console.error('Failed to like post.');
            }
        })
        .catch(error => console.error('Error liking post: ', error));
    }

    function dislikePost(postId) {
        fetch(`/posts/${postId}/dislike`, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const dislikesCountElement = document.getElementById(`dislikes-count-${postId}`);
                dislikesCountElement.innerText = data.dislikes;
            } else {
                console.error('Failed to dislike post.');
            }
        })
        .catch(error => console.error('Error disliking post: ', error));
    }

    function showReplyForm(postId) {
        const replyForm = document.getElementById(`reply-form-${postId}`);
        replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection
