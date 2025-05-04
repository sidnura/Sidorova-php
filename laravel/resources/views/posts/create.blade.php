@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создание поста</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" enctype="multipart/form-data" action="{{route('posts.store')}}">
        
        @csrf
        <div class="form-group mb-3">
        <label> Изображение поста</label>
        <input type="file" name="image" id="image" 
class="form-control">
        </div>
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
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group mb-3">
            <label for="content">Содержание</label>
            <textarea class="form-control" name="content" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>
@endsection