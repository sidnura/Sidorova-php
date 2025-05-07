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

    {{-- Удалены кнопки редактирования и удаления поста --}}
    
    {{-- Секция комментариев --}}
    @auth
        {{-- Показываем всем, кроме редакторов --}}
        @unless(auth()->user()->hasRole('editor'))
            <div class="comments-section mt-4">
                <h3 class="mb-3">
                    Комментарии 
                    <span class="badge bg-secondary">{{ $post->comments->count() }}</span>
                </h3>

                {{-- Список комментариев --}}
                @if($post->comments->isEmpty())
                    <div class="alert alert-info">Пока нет комментариев. Будьте первым!</div>
                @else
                    @foreach($post->comments as $comment)
                        <div class="comment mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $comment->user->name }}</h5>
                                <p class="card-text">{{ $comment->content }}</p>
                                <small class="text-muted">
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- Форма добавления комментария --}}
                @can('comments.create')
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Добавить комментарий</h4>
                            <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="content" class="form-control" rows="3" required 
                                              placeholder="Напишите ваш комментарий..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning mt-3">
                        У вас нет прав для добавления комментариев
                    </div>
                @endcan
            </div>
        @else
            {{-- Сообщение для редакторов --}}
            <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle"></i> Редакторам недоступна работа с комментариями
            </div>
        @endunless
    @else
        {{-- Сообщение для неавторизованных пользователей --}}
        <div class="alert alert-warning mt-4">
            <i class="fas fa-exclamation-triangle"></i> 
            <a href="{{ route('login') }}" class="alert-link">Войдите</a>, чтобы видеть комментарии
        </div>
    @endauth
</div>
@endsection
