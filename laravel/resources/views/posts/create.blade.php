@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создание поста</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- Поле для загрузки изображения -->
        <div class="form-group mb-3">
            <label for="image">Изображение поста</label>
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
        
        <!-- Выбор автора -->
        <div class="form-group mb-3">
            <label for="user_id">Автор</label>
            <select name="user_id" 
                    id="user_id"
                    class="form-control @error('user_id') is-invalid @enderror" 
                    required>
                <option value="">-- Выберите автора --</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Заголовок поста -->
        <div class="form-group mb-3">
            <label for="title">Заголовок</label>
            <input type="text" 
                   class="form-control @error('title') is-invalid @enderror" 
                   name="title" 
                   id="title"
                   value="{{ old('title') }}"
                   required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Содержание поста -->
        <div class="form-group mb-3">
            <label for="content">Содержание</label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                      name="content" 
                      id="content"
                      rows="5" 
                      required>{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection