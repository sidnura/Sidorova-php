@extends('layouts.app')

@section('content')
<div class="container">
    <div class="post-image mb-4">
        @if($post->hasMedia('post_images'))
            <img src="{{ $post->getFirstMediaUrl('post_images') }}" 
                 alt="{{ $post->title }}"
                 class="img-fluid rounded shadow"
                 style="max-height: 500px; width: 100%; object-fit: cover;">
        @else
            <div class="bg-light text-center p-5 rounded">
                <i class="fas fa-image fa-5x text-muted mb-3"></i>
                <p class="text-muted">Изображение отсутствует</p>
            </div>
        @endif
    </div>

    <div class="post-header mb-4">
        <h1 class="mb-2">{{ $post->title }}</h1>
        <p class="text-muted">
            Автор: <a href="#">{{ $post->user->name }}</a> | 
            Опубликовано: {{ $post->created_at->format('d.m.Y H:i') }}
        </p>
    </div>

    <div class="post-content card mb-4">
        <div class="card-body">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>

    <div class="comments-section">
        <h3 class="mb-3">
            Комментарии 
            <span class="badge bg-secondary">{{ $post->comments->count() }}</span>
        </h3>

        @if($post->comments->isEmpty())
            <div class="alert alert-info">Пока нет комментариев. Будьте первым!</div>
        @else
            @foreach($post->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <strong>{{ $comment->user->name }}</strong>
                            <small class="text-muted">
                                {{ $comment->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <p class="mb-0">{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach

            <!-- @foreach($post->comments as $comment)
    <div class="card mb-3">
        <div class="card-body">
            <p class="card-text">{{ $comment->content }}</p>
            <p class="text-muted small">
                {{ optional($comment->user)->name ?? 'Гость' }} • 
                {{ $comment->created_at->diffForHumans() }}
            </p>
        </div>
    </div>
@endforeach -->
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Добавить комментарий</h4>
                <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                    @csrf
                    <div class="mb-3">
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить комментарий</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection