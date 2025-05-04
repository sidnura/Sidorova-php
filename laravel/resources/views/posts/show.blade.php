@extends('layouts.app')

@section('content')
<div class="post">
    @if($post->hasMedia('posts'))
        <img src="{{ $post->getFirstMediaUrl('posts') }}" class="img-fluid mb-4">
    @endif
</div>
<div class="container">
    <h1>{{$post->title}}</h1>
    <p class="text-muted">Автор: {{$post->user->name}}</p>
    <div class="card mb-4">
        <div class="card-body">
            {{$post->content}}
        </div>
    </div>
    <h3>Комментарии</h3>
    @if($post->comments->isEmpty())
        <div class="alert alert-info">Пока нет комментариев</div>
    @else
        @foreach($post->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p>{{$comment->content}}</p>
                    <small class="text-muted">Автор: {{$comment->user->name}}</small>
                </div>
            </div>
        @endforeach
    @endif
    <form method="POST" action="{{route('comments.store')}}">
        @csrf
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input type="hidden" name="user_id" value="{{$post->user_id}}">
        <div class="form-group mb-3">
            <label for="content">Добавить комментарий</label>
            <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
@endsection