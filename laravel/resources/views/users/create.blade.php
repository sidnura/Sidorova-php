@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создание пользователя</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('users.store')}}">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Имя</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group mb-3">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Создать</button>
        <a href="{{route('users.index')}}" class="btn btn-primary mb-3">Отмена</a>
    </form>
</div>
@endsection