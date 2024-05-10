<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lara Blog</title>
</head>
<body>
    <h1>{{$post->title}}</h1>
    <x-post-meta :post="$post" />
    <!-- <div>Posted {{$post->date->diffForHumans() }} by {{$post->author}}</div> -->
    <div>{{$post->contents}}</div>
</body>
</html>