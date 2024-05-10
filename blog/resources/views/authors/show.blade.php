<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lara Blog</title>
</head>

<body>
    <h1>My personal blog</h1>

    @if ($posts->count())
    <h1>Latest post by {{$authorName}}</h1>

    <x-post-items :posts="$posts" />

    @endif
</body>

</html>