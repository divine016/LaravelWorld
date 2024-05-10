<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lara Blog</title>
</head>

<body>
    <h1><a href="/">{{ config('app.name') }}  </a></h1>

    <x-post-items :posts="$posts" />


   
  
</body>

</html>