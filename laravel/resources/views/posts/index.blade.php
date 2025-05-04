@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список постов</h1>
    <a href="{{route('posts.create')}}" class="btn btn-primary mb-3">Создать пост</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Автор</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>
                        <a href="{{route('posts.edit', $post)}}" class="btn btn-primary mb-3">Редактировать</a>
                        <a href="{{route('posts.show', $post)}}" class="btn btn-primary mb-3">Просмотр</a>
                        <!-- <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection