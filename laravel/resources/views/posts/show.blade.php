@extends('layouts.app')

@section('content')
<div class="container">

    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary mb-4">
        ← Назад к списку постов
    </a>

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
                <div class="comment mb-3">
                    <p><strong>{{ $comment->user->name }}</strong></p>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Добавить комментарий</h4>
                <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Выберите пользователя для комментария</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- выберите пользователя --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

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
