@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список постов</h1>
    @can('create', App\Models\Posts\Post::class)
        <a href="{{route('posts.create')}}" class="btn btn-primary mb-3">Создать пост</a>
    @endcan
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
                        <div class="btn-group" role="group">
                            <a href="{{route('posts.show', $post)}}" class="btn btn-sm btn-outline-primary">Просмотр</a>
                            
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                            @endcan
                            
                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection