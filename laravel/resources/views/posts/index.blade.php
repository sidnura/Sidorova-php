@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h1>Список постов</h1>
    </div>

    <div class="mb-4">
        <a href="{{ route('posts.create') }}" class="btn btn-outline-primary rounded shadow-sm">
            Создать пост
        </a>
    </div>


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
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">Просмотр</a>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">Редактировать</a>

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
