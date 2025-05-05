<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактирование поста</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('posts.update', $post)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
        <label>Автор</label>
        <select name="user_id" class="form-control" required>
            @foreach(\App\Models\User::all() as $user)
                <option value="{{ $user->id }}">{{$user->name}}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group mb-3">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" value="{{$post->title}}" required>
        </div>
        <div class="form-group mb-3">
            <label for="content">Содержание</label>
            <textarea class="form-control" name="content" rows="5" required>{{$post->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Обновить</button>
    </form>
</div>
@endsection -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>
    
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>
        
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection