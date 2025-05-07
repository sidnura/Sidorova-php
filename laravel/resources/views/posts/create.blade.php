@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создание поста</h1>
    
    @auth
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>Ошибки валидации:</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Поле для изображения -->
            <div class="form-group mb-3">
                <label for="image">Изображение поста (необязательно)</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       name="image" 
                       id="image"
                       accept="image/jpeg,image/png,image/webp">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">
                    Разрешены форматы: JPEG, PNG, WebP. Максимальный размер: 2MB.
                </small>
            </div>
            
            <!-- Автор (скрытое поле) -->
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            
            <!-- Заголовок -->
            <div class="form-group mb-3">
                <label for="title">Заголовок*</label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       name="title" 
                       id="title"
                       value="{{ old('title') }}"
                       required
                       placeholder="Введите заголовок поста">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Содержание -->
            <div class="form-group mb-3">
                <label for="content">Содержание*</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          name="content" 
                          id="content"
                          rows="8" 
                          required
                          placeholder="Напишите содержание поста">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Кнопки -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Создать пост
                </button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Отмена
                </a>
            </div>
        </form>
    @else
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i> Для создания поста необходимо 
            <a href="{{ route('login') }}" class="alert-link">войти в систему</a>.
        </div>
        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Вернуться к списку постов
        </a>
    @endauth
</div>
@endsection