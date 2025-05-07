@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary mb-4">
        ← Назад к списку постов
    </a>

    <h1>Редактирование поста</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="image">Изображение поста</label>
            @if($post->getImageUrl())
                <div class="mb-2">
                    <img src="{{ $post->getImageUrl() }}" alt="Current post image" style="max-width: 300px;">
                </div>
            @endif
            <input type="file" 
                   class="form-control @error('image') is-invalid @enderror" 
                   name="image" 
                   id="image"
                   accept="image/jpeg,image/png,image/webp">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Автор</label>
            <select name="user_id" class="form-control" required>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="title">Заголовок</label>
            <input type="text" 
                   class="form-control @error('title') is-invalid @enderror" 
                   name="title" 
                   value="{{ old('title', $post->title) }}" 
                   required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="content">Содержание</label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                      name="content" 
                      rows="5" 
                      required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Обновить</button>
    </form>
</div>
@endsection
