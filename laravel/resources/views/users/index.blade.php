@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список пользователей</h1>    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{route('users.edit', $user)}}" class="btn btn-primary mb-3">Редактировать</a>
                        <!-- <form action="{{route('users.destroy',$user)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary mb-3" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('users.create')}}" class="btn btn-primary mb-3">Создать пользователя</a>
</div>
@endsection