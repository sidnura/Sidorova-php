<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Новый пост</title>
</head>
<body>
    <h1>Новый пост: {{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p>Перейти к посту: <a href="{{ $url }}">{{ $url }}</a></p>
</body>
</html>
